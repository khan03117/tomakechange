<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\Chat;
use App\Models\ContactDetail;
use App\Models\Expert;
use App\Models\Policy;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;
use Illuminate\Support\Carbon;

class PusherController extends Controller
{
    public function chat()
    {
        $title = "Chat";
        $socials = ContactDetail::where('type', 'social')->get();
        $policies = Policy::select('url', 'title')->get();
        $received_id = $_GET['receipt_id'] ?? null;
        $endate = Carbon::now()->subMonth()->format('Y-m-d');
       
        if (Auth::user()->designation == "User") {
            $items = User::where('designation', 'Expert')->whereIn('uid', function ($q) use($endate) {
                $q->from('user_sessions')->select('expert_id')->where('user_id', Auth()->user()->id)->whereDate('apt_date', '>', $endate);
            })->with('expertdata:id,profile_image')
                ->get();
            $arr = User::where('designation', 'Expert')->whereIn('uid', function ($q) use($endate) {
                $q->from('user_sessions')->select('expert_id')->where('user_id', Auth()->user()->id)->whereDate('apt_date', '>', $endate);
            })->pluck('id')->toArray();
        }
        if (Auth::user()->designation == "Expert") {
            $items = User::where('designation', 'User')->whereIn('id', function ($q) use($endate) {
                $q->from('user_sessions')->select('user_id')->where('expert_id', Auth()->user()->uid)->whereDate('apt_date', '>', $endate);
            })->get();
            $arr = User::where('designation', 'User')->whereIn('id', function ($q) use($endate) {
                $q->from('user_sessions')->select('user_id')->where('expert_id', Auth()->user()->uid)->whereDate('apt_date', '>', $endate);
            })->pluck('id')->toArray();
        }
        // return response()->json($items);
        // die;
        if ($received_id && !in_array($received_id, $arr)) {
            return redirect()->back();
        }
        $chats = null;
        $receiver = null;
        if ($received_id && in_array($received_id, $arr)) {

            Chat::where(['to_id' => auth()->user()->id, 'from_id' => $received_id])->update(['is_read' => '1']);
            $chats = Chat::whereIn('from_id', [Auth::user()->id, $received_id])
                ->whereIn('to_id', [Auth::user()->id, $received_id])
                ->latest()
                ->limit(50)
                ->get();
            $receiver = User::where('id', $received_id)->first();
        }
        $res = compact('title', 'socials', 'policies', 'items', 'received_id', 'chats', 'receiver');

        return view('frontend.chat.index', $res);
    }
    public function sendMessage(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');

        if ($request->file('file')) {
            $file  = $request->file('file');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('chat'), $filename);
            $fileUrl = url('public/chat') . '/' . $filename;
            $originalname = $file->getClientOriginalName();
        } else {
            $originalname = null;
            $fileUrl = null;
        }
        if (!$originalname && !$request->message) {
            return false;
        }

        // Create a new message
        $chat_id = Chat::insertGetId([
            'message_text' => $request->input('message'),
            'from_id' => $request->input('from_id'),
            'to_id' => $request->input('recipient_id'),
            'file' => $fileUrl,
            'file_name' => $originalname,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        // $chat = Chat::where('id', $chat_id)->fisrt();
        // Broadcast the message
        event(new PusherBroadcast(
            $request->input('message'),
            $request->input('from_id'),
            $request->input('recipient_id'),
            $fileUrl,
            $chat_id,
            $originalname,
            date('Y-m-d H:i:s')

        ));
        return "";
        // return view('frontend.chat.receive', [
        //     'message' => $request->get('message'),
        //     'chatroomId' => 'chatroom'. $request->input('from_id'),
        //     'recever_id' => $request->input('recipient_id'),
        //     'receipant' => $request->input('recipient_id'),
        //     'file'  => $fileUrl,
        //     'file_name'  => $originalname,
        //     'created_at'  =>  date('Y-m-d H:i:s')
        // ]);
    }
    public function receive(Request $request)
    {

        $chatroomId = $request->get('chatroomId');


        return view('frontend.chat.receive', [
            'message' => $request->get('message'),
            'chatroomId' => $chatroomId,
            'recever_id' => $request->get('recever_id'),
            'receipant' => $request->get('recever_id'),
            'file'  => $request->get('file'),
            'file_name'  => $request->get('file_name'),
            'created_at'  => $request->get('created_at'),
        ]);
    }
    public static function isUserOnline($channelName, $userId)
    {
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ];

        // Create a new Pusher instance
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        try {
            // Get the presence information for the channel
            $response = $pusher->get('/channels/' . $channelName);
            echo json_encode($response);

            // Check if the user is in the list of online users
            // foreach ($response->users as $user) {
            //     if ($user->id === $userId) {
            //         return true;
            //     }
            // }


        } catch (Exception $e) {
            // Handle the exception appropriately
            return $e;
        }
    }
    public static function get_unread_msg($id)
    {
        $myid = auth()->user()->id;
        $data = [
            'from_id' => $id,
            'to_id' => $myid,
            'is_read' => '0'
        ];
        $items = Chat::where($data)->count();
        return ['to' => $myid, 'count' => $items];
    }
}
