<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DyteController extends Controller
{
    public function join_call(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:slots,id',
            'user_id' => 'required|exists:slots,user_id',
            'mid' => 'required|exists:slots,meet_id'
        ]);
        $mid = $request->mid;
        $eid = Auth::user()->uid;
        $uid = $request->user_id;
        $id = $request->id;
        $data = [
            'user_id' => $uid,
            'meet_id' => $mid,
            'id' => $id,
            'expert_id' => $eid
        ];
        // echo json_encode($data);
        // die;

        $check = Slot::where($data)->with('user_session')->first();
        

        if ($check) {
            $mode = strtolower($check['user_session']['mode']);
            $username = Auth::user()->name;
            $id = env('DYTE_ID');
            $key = env('DYTE_KEY');
            $auth = base64_encode($id.':'.$key);
            $res['auth'] = $auth;
            $curl = curl_init();
            $meet_id = $check['meet_id'];
            

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.cluster.dyte.in/v2/meetings/'.$meet_id.'/participants',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "name": "' . $username . '",
                    "picture": "http://placeimg.com/640/480",
                    "custom_participant_id": "' . $check['user_id'] . '",
                    "preset_name": "'.$mode.'"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Basic ' . $auth
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $res['token'] =  json_decode($response)->data->token;

            $res['slot'] = $check;
            $res['usid'] = $check['user_session']['id'];
            
            return view('frontend.vcall', $res);
        }
    }
}