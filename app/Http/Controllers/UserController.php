<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirm;
use App\Mail\CustomMail;
use App\Models\Cart;
use App\Models\CartPayment;
use App\Models\ContactDetail;
use App\Models\Expert;
use App\Models\Package;
use App\Models\Policy;
use App\Models\FindExpert;
use App\Models\ExpertSubCategory;
use App\Models\Slot;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Exports\UserExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\AllTraits\MyTrait;

class UserController extends Controller
{
     use MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
     public function export(){
        return Excel::download(new UserExcel, 'users.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['user'] = User::where('id', Auth::user()->id)->first();

        return view('frontend.user.setting', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',

            'name' => 'required|min:4'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile
        ];
        $data['password'] = Hash::make($request->password);
        $id = Auth::user()->id;


        User::where(['id' => $id, 'designation' => 'User'])->update($data);


        return redirect()->back()->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function dashboard()
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['title'] = "User Dashboard";
        $res['user'] = User::where('users.id', Auth::user()->id)->join('states', 'states.id', '=', 'users.state_id')
            ->join('cities', 'cities.id', '=', 'users.city_id')
            ->select(['users.*', 'states.state', 'cities.city'])->first();
        // echo json_encode($res['user']);
        // die;
        return view('frontend.user.dashboard', $res);
    }
    public function consultation()
    {
        $uid = Auth::user()->id;
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['slots'] = Slot::where('user_id', $uid)
            ->with('expert')->orderBy('slot', 'DESC')
            ->get();
        // echo json_encode($res);
        // die;
        return view('frontend.user.slots', $res);
    }
    public function join_meet(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:slots,meet_id',
            'sid' => 'required|exists:slots,id'
        ]);
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $mid = $request->id;
        $uid = Auth::user()->id;
        $sid = $request->sid;
        $data = [
            'user_id' => $uid,
            'meet_id' => $mid,
            'id' => $sid
        ];
        $udata = [
            'user_id' => $uid,
            'slot_id' => $sid
            ];
    
        $check = Slot::where($data)->first();
        
        if ($check) {
            $session = UserSession::where($udata)->first();
            // return response()->json($session);
            // die;
            if($session){
                $mode = strtolower($session['mode']);
                $username = Auth::user()->name;
                $id = env('DYTE_ID');
                $key = env('DYTE_KEY');
                $auth = base64_encode($id . ':' . $key);
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
                $res['usid'] = $uid;
                return view('frontend.vcall', $res);
            }
        }
    }
    public function reschedule($id)
    {
        // echo base64_encode(36);
        // die;
        date_default_timezone_set('Asia/kolkata');
        $sid =  base64_decode($id);

        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $uitem = UserSession::where('id', $sid)->first();

        $slot = Slot::where('id', $uitem['slot_id'])->with('cart')->first();
        $start = date('Y-m-d H:i:s', strtotime($slot['slot']));
        $current = date('Y-m-d H:i:s');
        $diff = strtotime($start) - strtotime($current);
        $hour =  $diff/(60*60);
        // echo json_encode($slot);
        $res['is_allow'] = $hour > 4 ? true : false;
        $res['slot'] = $slot;
        $res['expert'] = Expert::where('id', $slot['expert_id'])->first();
        $res['user_session'] = $uitem;
        $res['url'] = 'reschedule.update';
        return view('frontend.user.reschedule', $res);
    }
    public function update_reschedule(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'slot' => 'required'
        ]);
        $nsid = $request->slot;
        $app_date = $request->date;
        $usession = UserSession::where('id', $id)->first();
        // echo json_encode($usession);
        $cart = Cart::where('id', $usession['cart_id'])->first();
        $slot = Slot::where('id', $usession['slot_id'])->first();
        $nslot = Slot::where('id', $nsid)->first();
        $data = [
            'is_paid' => '1',
            'meet_response' => $slot['meet_response'],
            'meet_id' => $slot['meet_id'],
            'cart_id' => $usession['cart_id'],
            'user_id' => Auth::user()->id,
           
        ];
        
        $udata = [
            'is_paid' => '0',
            'meet_response' => null,
            'meet_id' => null,
            'cart_id' => null,
            'user_id' => null,
        ];
        // echo json_encode($data);
        // die;
        Slot::where('id', $nsid)->update($data);
        Slot::where('id', $slot['id'])->update($udata);
        
        $find = FindExpert::where('cart_id', $cart['id'])->first();
        
        UserSession::where('id', $id)->update(['slot_id' => $nsid, 'is_rescheduled' => '1', 'reschedule_by' => 'Client',   'apt_date' => date('Y-m-d', strtotime($nslot['slot']))]);
         $user = User::where('users.id', $cart['user_id'])
            ->join('cities', 'cities.id', '=', 'users.city_id', 'left')
            ->join('states', 'states.id', '=', 'users.state_id', 'left')
            ->select(['users.*', 'cities.city', 'states.state'])
            ->first();
        $expert = Expert::where('id', $cart['expert_id'])->first();
        $email = $user['email'];
        
        
         $exps = ExpertSubCategory::where('expert_id',  $expert['id'])
            ->join('sub_categories', 'sub_categories.id', '=', 'expert_sub_categories.sub_category_id')
            ->select(['sub_categories.sub_category'])->get();
        // return response()->json($exps);
        // die;
            $e_exps = '';
            foreach($exps as $ex){
                $e_exps .= "<span style='margin-right:10px;'>{$ex['sub_category']}</span>";
            }
        $s_Date = date('d-M-Y', strtotime($nslot['slot']));
        $s_time = date('h:i A', strtotime($nslot['slot'])).' - '.date('h:i A', strtotime($nslot['slot_end']));
        $mailData = [
            'expert' => $expert['name'],
            'slot' => $nslot['slot'],
            'duration' => $nslot['duration'],
            'end' => $nslot['slot_end'],
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['remember_token'],
            'exps' => $e_exps,
            's_time' => $s_time,
            'mode' => $find['contact_mode'],
             'is_new' => ' Rescheduled '
        ];
        Mail::to($email)->send(new BookingConfirm($mailData));
        
         $s_Date = date('d-M-Y', strtotime($nslot['slot']));
            $s_time = date('h:i A', strtotime($nslot['slot'])).' - '.date('h:i A', strtotime($nslot['slot_end']));
            $scat = json_decode($find['sub_cats']);
            $ecat = json_decode($find['end_cats']);
            
            $primary = '';
            $secondary = '';
            
            foreach($scat as $s){
                $primary .= "<span style='margin-right:10px;'>{$s->sub_category}</span>";
            }
            foreach($ecat as $s){
                $secondary .= "<span style='margin-right:10px;'>{$s->end_category}</span>,";
            }
            
            $subject = 'Rescheduled Session Slot';
            $mailData = [
                'subject' => $subject,
                'body' => "Session Booking with {$expert['name']} and {$user['name']} ON {$s_Date} To  {$s_time} "
            ];
             $e_mail= "<p>Dear {$expert['name']},</p>

                        <p>Your next session details are as follows :</p>  
                        
                        <p>Session details with : {$user['name']}<br>
                        Location : {$user['city']} , {$user['state']}, {$user['pincode']} <br>
                        Gender : {$user['gender']}<br>
                        Age : {$user['age']}<br>
                        Language : {$find['languages']}<br>
                        Session date : {$s_Date}<br>
                        Session Time : {$s_time}<br>
                        Session duration : {$nslot['duration']} minutes<br>
                        Session Mode : {$find['contact_mode']}<br>
                        
                        Reasons for session : {$primary} <br>
                        Other reason : {$secondary}<br>
                        
                        Session Link : https://edha.life/login </p>
                        ";
            $mailData1 = [
                'subject' => $subject.' with '.$user['name'],
                'body' => $e_mail
            ];
           
        Mail::to(env('BOOKING_RECEIVED'))->send(new CustomMail($mailData));
        Mail::to($expert['email'])->send(new CustomMail($mailData1));
        
        
        
       
        $sdate = date('d-M-Y', strtotime($nslot['slot']));
        $stime = date('h:i A', strtotime($nslot['slot']));
        $msg = "RESCHEDULED booked session with {$expert['name']} to - Date : {$sdate} Time : {$stime} Link to join session : https://edha.life/login -Team edha";
        $msg2 = "RESCHEDULED booked session with {$user['name']} to - Date : {$sdate} Time : {$stime} Link to join session : https://edha.life/login -Team edha";
       $this->send_sms('91'.$user['mobile'], $msg);
        $this->send_sms('91'.$expert['mobile'], $msg2);
       
        return redirect()->to('user/packages')->with('success', 'Rescheduled done');
    }
    public function cancel_booking(Request $request, $id)
    {
        $uitem = UserSession::where('id', $id)->first();
        UserSession::where('id', $id)->update(['status' => 'Cancelled']);
        Slot::where('id', $uitem['slot_id'])->update(['booking_status' => 'Cancel']);
        $slot = Slot::where('id', $uitem['slot_id'])->first();

        if ($slot) {
            $expert = Expert::where('id', $slot['expert_id'])->first();
            if ($expert) {
                $mailData = [
                    "subject" => "Session Booking Cancelled.",
                    "body" => "Session Booking with {$expert['name']} ON {$slot['slot']} To  {$slot['slot_end']} has been cancelled."
                ];
                Mail::to($expert['email'])->send(new CustomMail($mailData));
                Mail::to(env('BOOKING_RECEIVED'))->send(new CustomMail($mailData));
            }
        }

        return redirect()->back();
    }
    public function mypackages()
    {
        date_default_timezone_set('Asia/kolkata');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $uid = Auth::user()->id;
        $after = date('Y-m-d H:i:s', strtotime('- 5 days'));
        
        $res['items'] = UserSession::where('user_id', $uid)->with('slot')->with('expert:id,name')
        
        ->get();
        // echo json_encode($res['items']);
        // die;
        if (count($res['items']) > 0) {
            $res['cart'] = Cart::where('id', $res['items'][0]['cart_id'])->with('expert:id,name,profile_image')->first();
        } else {
            $res['cart'] = new Cart();
        }
        // echo json_encode($res['items']);
        // die;
        return view('frontend.user.packages', $res);
    }
    public function make_schedule($id)
    {
        date_default_timezone_set('Asia/kolkata');
        $now = date('Y-m-d H:i:s');
        $sid =  base64_decode($id);
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $uitem = UserSession::where('id', $sid)->with('cart')->first();
        if (!$uitem['slot_id']) {
            $res['slot'] = Package::where('id', $uitem['cart']['package_id'])->first();
            $res['expert'] = Expert::where('id', $uitem['cart']['expert_id'])->first();
            $res['user_session'] = $uitem;
            $res['url'] = 'make_schedule.update';
            $res['is_allow'] = true;

            return view('frontend.user.reschedule', $res);
        } else {
            return redirect()->route('mypackages');
        }
    }
    public function save_schedule(Request $request, $usid)
    {
        $request->validate([
            'date' => 'required',
            'slot' => 'required'
        ]);
        $uitem = UserSession::where('id', $usid)->first();
        $nsid = $request->slot;
        $slot = Slot::where('id', $nsid)->first();
        $cart = Cart::where('id', $uitem['cart_id'])->with('fee')->first();
        $find = FindExpert::where('cart_id', $cart['id'])->first();
        $duration = abs(strtotime(date('Y-m-d')) - strtotime($cart['fee']['duration'])) / 60;
        $id = env('DYTE_ID');
        $key = env('DYTE_KEY');
        $auth = base64_encode($id . ':' . $key);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.cluster.dyte.in/v2/meetings/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "title": "Reschedule Meeting",
                "preferred_region": "ap-south-1",
                "record_on_start": false,
                "live_stream_on_start": false
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . $auth
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $meet_resonse =  json_encode(json_decode($response)->data);
        $meet_id = json_decode($response)->data->id;
        $data = [
            'slot_end' =>  date('Y-m-d H:i:s', strtotime($duration . " minutes", strtotime($slot['slot']))),
            'user_id' => $uitem['user_id'],
            'is_paid' => '1',
            'updated_at' => date('Y-m-d H:i:s'),
            'meet_id' => (string) $meet_id,
            'meet_response' => $meet_resonse,
            'cart_id' => $cart['id'],
            'order_id' => $cart['order_id']
        ];
        Slot::where('id', $nsid)->update($data);
        $udata = [
            'slot_id' => $nsid,
            'apt_date' => date('Y-m-d', strtotime($slot['slot']))
        ];
      $user = User::where('users.id', $cart['user_id'])
            ->join('cities', 'cities.id', '=', 'users.city_id', 'left')
            ->join('states', 'states.id', '=', 'users.state_id', 'left')
            ->select(['users.*', 'cities.city', 'states.state'])
            ->first();
        $expert = Expert::where('id', $cart['expert_id'])->first();
        $email = $user['email'];
        
        
         $exps = ExpertSubCategory::where('expert_id',  $expert['id'])
            ->join('sub_categories', 'sub_categories.id', '=', 'expert_sub_categories.sub_category_id')
            ->select(['sub_categories.sub_category'])->get();
       
            $e_exps = '';
            foreach($exps as $ex){
                $e_exps .= "<span style='margin-right:10px;'>{$ex['sub_category']}</span>";
            }
        $s_Date = date('d-M-Y', strtotime($slot['slot']));
        $s_time = date('h:i A', strtotime($slot['slot'])).' - '.date('h:i A', strtotime($slot['slot_end']));
        $mailData = [
            'expert' => $expert['name'],
            'slot' => $slot['slot'],
            'duration' => $slot['duration'],
            'end' => $slot['slot_end'],
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['remember_token'],
            'exps' => $e_exps,
            's_time' => $s_time,
            'mode' => $find['contact_mode'],
             'is_new' => ' Rescheduled '
        ];
        Mail::to($email)->send(new BookingConfirm($mailData));
        
         $s_Date = date('d-M-Y', strtotime($slot['slot']));
            $s_time = date('h:i A', strtotime($slot['slot'])).' - '.date('h:i A', strtotime($slot['slot_end']));
            $scat = json_decode($find['sub_cats']);
            $ecat = json_decode($find['end_cats']);
            
            $primary = '';
            $secondary = '';
            
            foreach($scat as $s){
                $primary .= "<span style='margin-right:10px;'>{$s->sub_category}</span>";
            }
            foreach($ecat as $s){
                $secondary .= "<span style='margin-right:10px;'>{$s->end_category}</span>,";
            }
            
            $subject = 'Rescheduled Session Slot';
            $mailData = [
                'subject' => $subject,
                'body' => "Session Booking with {$expert['name']} and {$user['name']} ON {$s_Date} To  {$s_time} "
            ];
             $e_mail= "<p>Dear {$expert['name']},</p>

                        <p>Your next session details are as follows :</p>  
                        
                        <p>Session details with : {$user['name']}<br>
                        Location : {$user['city']} , {$user['state']}, {$user['pincode']} <br>
                        Gender : {$user['gender']}<br>
                        Age : {$user['age']}<br>
                        Language : {$find['languages']}<br>
                        Session date : {$s_Date}<br>
                        Session Time : {$s_time}<br>
                        Session duration : {$slot['duration']} minutes<br>
                        Session Mode : {$find['contact_mode']}<br>
                        
                        Reasons for session : {$primary} <br>
                        Other reason : {$secondary}<br>
                        
                        Session Link : https://edha.life/login </p>
                        ";
            $mailData1 = [
                'subject' => $subject.' with '.$user['name'],
                'body' => $e_mail
            ];
           
        Mail::to(env('BOOKING_RECEIVED'))->send(new CustomMail($mailData));
        Mail::to($expert['email'])->send(new CustomMail($mailData1));
        UserSession::where('id', $usid)->update($udata);
        return redirect()->back()->with('success', 'Slot Alloted');
    }
    public function mypayments()
    {
        $id = Auth::user()->id;
        $fdata = [
            'user_id' => $id,

        ];
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['items'] = CartPayment::where($fdata)->with('expert:id,name')->where('cca_status', 'Success')->get();
        // echo json_encode($res['items']);
        // die;
        return view('frontend.user.payment', $res);
    }
}
