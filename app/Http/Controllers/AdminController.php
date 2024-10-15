<?php

namespace App\Http\Controllers;

use App\Http\AllTraits\MyTrait;
use App\Mail\AdminMail;
use App\Mail\RejectApplication;
use App\Models\Cart;
use App\Models\CartPayment;
use App\Models\CashMemo;
use App\Models\FindExpert;
use App\Models\Category;
use App\Models\ContactDetail;
use App\Models\Expert;
use App\Models\ExpertFee;
use App\Models\ExpertSubCategory;
use App\Models\JoinRequest;
use App\Models\Language;
use App\Models\Subscribe;
use App\Models\Slot;
use App\Models\State;
use App\Models\User;
use App\Models\UserSession;
use App\Mail\BookingConfirm;
use App\Mail\CustomMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    use MyTrait;
    public function index()
    {
        if (Auth::user()) {
            return redirect()->to('admin/dashboard');
        } else {
            return view('admin.index');
        }
    }
    public function forget (){
        $res['title'] = 'Forget Password';
        return view('admin.forget', $res);
    }
    public function dashboard()
    {
        $res['title'] = 'Welcome to edha Dashboard';
        $fdata = [
            'status' => 'Pending'
        ];
        $categories = Category::withCount(['sessions' => function($q){
            $q->where('status', 'Pending')->where('slot_id', '!=', null);
            }])->withCount('completed_sessions')->withCount('cancelled_sessions')->get();
        // echo json_encode($categories);
        // die;

        foreach ($categories as $cat) {
            $status = ['Pending', 'Done', 'Cancelled'];

            foreach ($status as $sts) {
                $key = $sts . '_sessions_' . $cat['url'];

                $ct = UserSession::join('find_experts', 'find_experts.cart_id', '=', 'user_sessions.cart_id')
                    ->where('find_experts.category_id', $cat['id']);
                if ($sts == 'Pending') {
                    $ct->whereIn('user_sessions.status', ['Pending', 'Rescheduled']);
                } else {
                    $ct->where('user_sessions.status', $sts);
                }
                $count = $ct->count();
                $res[$key]  = $count;
            }
        }
       
        foreach ($categories as $cat) {
            $status = ['Pending', 'Done', 'Cancelled'];

            foreach ($status as $sts) {
                $key = $sts . '_slot_' . $cat['url'];
                $c_t = UserSession::where('slot_id', '!=', null)
                    ->join('find_experts', 'find_experts.cart_id', '=', 'user_sessions.cart_id')
                    ->where('find_experts.category_id', $cat['id']);
                $c_t->where('user_sessions.status', $sts);
                $count = $c_t->count();
                $res[$key] = $count;
            }
        }
      

        $res['cats'] = $categories;




        return view('admin.dashboard', $res);
    }
    public function join_request()
    {
        $res['title'] = 'List of Join Request';
        $res['items'] = JoinRequest::orderBy('join_requests.id', 'DESC')
            ->join('states', 'states.id', 'join_requests.state')
            ->join('qualifications', 'qualifications.id', 'join_requests.qualification')
            ->select(['join_requests.*', 'states.state', 'qualifications.name as qualification'])
            ->with('post_detail')
            ->with('category')
            ->where('is_created', '0')
            ->get();
        // echo json_encode($res['items']);
        // die;
        return view('admin.experts.requests', $res);
    }
    public function join_request_create($id)
    {
        $res['title'] = 'Create Id Password';
        $res['item'] = JoinRequest::where('id', $id)->first();
        $res['items'] = Category::where('title', '!=', '')->get();
        $res['languages'] = Language::all();
        $res['states'] = State::all();
        if ($res['item']['is_created'] == '0') {
            return view('admin.experts.create_id', $res);
        } else {
            return redirect()->back()->with('error', 'Already Created');
        }
    }
    public function join_request_view($id)
    {
        $res['title'] = 'Resume';
        $res['item'] = JoinRequest::where('id', $id)->first();
        return view('admin.experts.resume', $res);
    }
    public function join_request_store(Request $request, $id)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'email' => 'required|unique:users,email|unique:experts,email',
            'mobile' => 'required|unique:users,mobile|unique:experts,mobile',
            'password' => 'required',
            'pincode' => 'required',
            'file' => 'image|mimes:png,jpg,jpeg,svg|max:2048',
            'fee' => 'required',
            'postname' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'pincode' => 'required',
            'mode' => 'required',
            'language' => 'required',
            'pincode' => 'required',
            'therapy' => 'max:150',
            'stream' => 'max:150'
        ]);
        date_default_timezone_set('Asia/kolkata');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
        } else {
            $file_name = $request->hfile;
        }
        $url = $this->make_url(Str::uuid() . '-' . $request->name);

        $data = [
            'profile_image' => $file_name,
            'url' => $url,
            'name' => $request->name,
            'email' => strtolower($request->email),
            'join_id' => $id,
            'mobile' => $request->mobile,
            'designation' => $request->apply_for,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'stream' => $request->stream,
            'therapy' => $request->therapy,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'pincode' => $request->pincode,
            'post_id' => $request->postname,
            'custom_postname' => $request->custom_post_name,
            'modes' => implode(',', $request->mode),
            'languages' => implode(',', $request->language),
            'additional_details' => $request->additional_details,
            'created_at' => date('Y-m-d H:i:s')
        ];
        // echo json_encode($data);
        // die;
        $uid = Expert::insertGetId($data);
        if ($request->expertises) {
            foreach ($request->expertises as $ex) {
                ExpertSubCategory::insert(['expert_id' => $uid, 'sub_category_id' => $ex]);
            }
        }
        if ($request->language) {
            foreach ($request->language as $lang) {
                $lid = Language::where('language', $lang)->first();
                if($lid){
                    DB::table('expert_languages')->insert(['expert_id' => $uid, 'language_id' => $lid['id'],  'created_at' => date('Y-m-d H:i:s')]);
                }
                
            }
        }
        $times = ['00:30:00', '01:00:00'];
        foreach ($request->fee as $i => $fee) {
            ExpertFee::insert(['expert_id' => $uid, 'fee' => $fee, 'duration' =>  $times[$i], 'rate' => $request->rate, 'fixed_fee' => $request->fixed_fee]);
        }

        $udata = [
            'uid' => $uid,
            'name' => $request->name,
            'email' => strtolower($request->email),
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'remember_token' => $request->password,
            'designation' => 'Expert',
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (User::insert($udata)) {
            JoinRequest::where('id', $id)->update(['is_created' => '1']);
            return redirect()->to('success-registration/' . $id)->with('success', 'Registration Added successfully');
        }
    }
    public function contact_details()
    {
        $res['title'] = 'List of Contact Details';
        $res['items'] = ContactDetail::all();
        return view('admin.contact_details', $res);
    }
    public function save_contact_details(Request $request)
    {
        $items = ContactDetail::all();
        foreach ($items as $item) {
            $name = $item['title'];
            $val = $request->$name;
            $data = [
                'c_val' => $val
            ];
            ContactDetail::where('id', $item['id'])->update($data);
        }
        return redirect()->back();
    }
    public function join_request_accept(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;
        $item = JoinRequest::where('id', $id)->first();
        JoinRequest::where('id', $id)->update(['offer_sent' => '1']);
        $email = $item['email'];
        $mailData = [
            'title' => 'Mail from edha',
            'body' => 'This is for testing email using smtp.',
            'uuid' => $item['uuid'],
            'name' => $item['first_name'] . ' ' . $item['last_name']
            // 'attachment' => public_path('upload/' . $item['resume'])
        ];
        Mail::to($email)->send(new AdminMail($mailData));
        return redirect()->back()->with('success', 'mail sent successfully');
    }
    public function join_request_reject(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'reason' => 'required'
        ]);
        $id = $request->id;
        $item = JoinRequest::where('id', $id)->first();
        $email = $item['email'];
        $mailData = [
            'title' => 'Mail from Edha',
            'body' =>  $request->reason,
            'uuid' => $item['uuid'],
            'name' => $item['first_name'] . ' ' . $item['last_name']
            // 'attachment' => public_path('upload/' . $item['resume'])
        ];
        Mail::to($email)->send(new RejectApplication($mailData));
        JoinRequest::where('id', $id)->update(['is_created' => '2', 'reason' => $request->reason]);
        return redirect()->back();
    }
    public function reschedule($id)
    {
        date_default_timezone_set('Asia/kolkata');
        $sid =  base64_decode($id);
        $uitem = UserSession::where('id', $sid)->first();
        $slot = Slot::where('id', $uitem['slot_id'])->with('cart')->first();
        $res['slot'] = $slot;
        $res['expert'] = Expert::where('id', $slot['expert_id'])->first();
        $res['user'] = User::where('id', $slot['user_id'])->first();
        $res['user_session'] = $uitem;
        $res['url'] = 'reschedule.update';
        $now = date('Y-m-d 00:00:00');
        $end = date('Y-m-d 23:00:00');
        $startTime = strtotime($now);
        $endTime = strtotime($end);
        $current = $startTime;
        $intervals = [];
        $interval = 30;
        while ($current <= $endTime) {
             $next = date("H:i", $current);
             if($next > "10:00"){
                    $intervals[] = date("H:i", $current);
             }
        
            
            $current = strtotime('+' . $interval . ' minutes', $current);
        }
        // echo json_encode($intervals);
        // die;
        $res['intervals'] = $intervals;
        return view('admin.booking.reschedule', $res);
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
        $cart = Cart::where('id', $usession['cart_id'])->first();
        $slot = Slot::where('id', $usession['slot_id'])->first();
         $nslot = Slot::where('id', $nsid)->first();
        $data = [
            'is_paid' => '1',
            'meet_response' => $slot['meet_response'],
            'meet_id' => $slot['meet_id'],
            'cart_id' => $usession['cart_id'],
            'user_id' => $usession['user_id'],
          
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
        #UserSession::where('id', $id)->update(['slot_id' => $nsid, 'is_rescheduled' => '1', 'reschedule_by' => 'Admin']);
          UserSession::where('id', $id)->update(['slot_id' => $nsid, 'is_rescheduled' => '1', 'reschedule_by' => 'Admin',   'apt_date' => date('Y-m-d', strtotime($nslot['slot']))]);
          
           $find = FindExpert::where('cart_id', $cart['id'])->first();
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
        
        
        
        
        
        // $sdate = date('d-M-Y', strtotime($nslot['slot']));
        // $stime = date('h:i A', strtotime($nslot['slot']));
        // $msg = "RESCHEDULED booked session with {$expert['name']} to - Date : {$sdate} Time : {$stime} Link to join session : https://edha.life/login -Team edha";
        // $msg2 = "RESCHEDULED booked session with {$user['name']} to - Date : {$sdate} Time : {$stime} Link to join session : https://edha.life/login -Team edha";
        // $this->send_sms('91'.$user['mobile'], $msg);
        // $this->send_sms('91'.$expert['mobile'], $msg2);
        
        return redirect()->to('admin/sessions/all/all')->with('success', 'Rescheduled done');
    }
    public function expert_statics()
    {
       $res['mid'] = $month = $_GET['month'] ?? null;
        $res['cid'] = $category = $_GET['cateogry'] ?? null;
        $res['eid'] = $expert = $_GET['expert'] ?? null;
        $exp = Expert::join('categories', 'categories.id', '=', 'experts.designation')
            ->select(['experts.id', 'name', 'designation', 'categories.category'])
            ->orderBy('experts.id', 'DESC');
        if($category)
        {
           $exp->where('categories.id', $category); 
        }
        if($expert)
        {
           $exp->where('experts.id', $expert); 
        }
        if ($month) {
            $exp->withCount(['open_sessions' => function ($q) use ($month) {
                $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
            }])
                ->withCount(['closed_sessions' => function ($q) use ($month) {
                    $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
                }])
                ->withCount(['cancelled_sessions' => function ($q) use ($month) {
                    $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
                }])
                ->withCount(['rescheduled_sessions' => function ($q) use ($month) {
                    $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
                }])
                ->withCount(['video_package' => function ($q) use ($month) {
                    $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
                }])
                ->withCount(['audio_package' => function ($q) use ($month) {
                    $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
                }])
                ->withCount(['single_package' => function ($q) use ($month) {
                    $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
                }])
                ->withCount(['multi_package' => function ($q) use ($month) {
                    $q->whereYear('created_at', date('Y', strtotime($month)))->whereMonth('created_at', date('m', strtotime($month)));
                }]);
        } else {
            $exp->withCount('open_sessions')
                ->withCount('closed_sessions')
                ->withCount('cancelled_sessions')
                ->withCount('rescheduled_sessions')
                ->withCount('video_package')
                ->withCount('audio_package')
                ->withCount('single_package')
                ->withCount('multi_package');
        }
        $experts = $exp->get();

        $res['items'] = $experts;
        $res['title'] = 'Expert Statics';
        $res['cats'] =  $categories = Category::withCount(['sessions' => function($q){
            $q->where('status', 'Pending')->where('slot_id', '!=', null);
            }])->withCount('completed_sessions')->withCount('cancelled_sessions')->get();
        $exps = Expert::select(['id', 'name'])->where('is_active', '1');
        if($category){
            $exps->where('designation', $category);
        }
         $res['experts']  = $exps->get();
        // echo json_encode($res['cats']);
        // die;
        return view('admin.reports.expert_statics', $res);
    }
    public function financial_report()
    {
        $res['month'] = $month = $_GET['month'] ?? date('Y-m-d');
        $cats = Category::withCount(['sessions' => function($q) use ($month){
            $q->whereMonth('apt_date', date('m', strtotime($month)))->whereYear('apt_date',  date('Y', strtotime($month)));
        }])
            ->withCount(['completed_sessions' => function($q) use ($month){
                  $q->whereMonth('apt_date', date('m', strtotime($month)))->whereYear('apt_date', date('Y', strtotime($month)));
            }])
            ->withCount(['cancelled_sessions' => function($q) use ($month){
                 $q->whereMonth('apt_date', date('m', strtotime($month)))->whereYear('apt_date', date('Y', strtotime($month)));
            }])
            ->withSum('fee_collection', 'base_amount')
            ->get();
        // return response()->json($cats);
        // die;
        $money = [];
       foreach($cats as $c){
           array_push($money, $c['fee_collection_sum_base_amount']);
       }
       $res['amount'] = $money;
        $res['title'] = 'Financial Report';
        $res['items'] = $cats;
        $res['all'] = UserSession::where('slot_id', '!=', null)->count();
        $completed = UserSession::where('slot_id', '!=', null)->where('status', '=', 'Done')->count();
        $cancelled = UserSession::where('slot_id', '!=', null)->where('status', '=', 'Cancelled')->count();
        $res['cancelled']  = $cancelled == 0 ? 1 : $cancelled;
        $res['completed']  = $completed == 0 ? 1 : $completed;
    //   return response()->json($cats);
    //   die;
        return view('admin.reports.financial_report', $res);
    }
    public function profile(){
        $res['title'] = 'Profile';
         return view('admin.profile', $res);
    }
    public function profile_update(Request $request){
        $request->validate(
            ['password' => ['required', Password::min(8)
        ->mixedCase()
        ->letters()
        ->numbers()
        ->symbols()
        ->uncompromised(),
            ],]
            );
        $data = [
            'password' => Hash::make($request->password),
            'remember_token' => $request->password
            ];
        if(User::where('id', Auth::user()->id)->update($data)){
            return redirect()->back()->with('success', 'Updated successfully');
        }
    } 
    public function subscribers(){
        $res['title'] = 'List of Subscribers';
        $res['items'] = Subscribe::orderBy('id', 'DESC')->get();
        return view('admin.reports.subscribers', $res);
    }
     public function logout()
    {
        //Auth::logout();
        session()->flush();
        return redirect()->to('admin');
    }
    public function users(){
        $res['title'] = 'List of Clients';
        $res['items'] = User::where('designation', 'User')
         ->where('is_active', '1')
        ->join('cities', 'cities.id', '=', 'users.city_id')
        ->join('states', 'states.id', '=', 'users.state_id')
        ->orderBy('users.id', 'DESC')->select(['users.*', 'cities.city', 'states.state'])->paginate(10);
        return view('admin.reports.users', $res);
    }
    public function cancel_booking($id){
       
        $id = base64_decode($id);
        $sessions = UserSession::where('cart_id', $id)->with('slot')->get();
        $cart = Cart::where('id', $id)->first();
        $cartpayment = CartPayment::where('cart_id', $id)->first();
        $user = User::where('users.id', $cart['user_id'])
        ->join('states', 'states.id', '=', 'users.state_id')
        ->join('cities', 'cities.id', '=', 'users.city_id')
        ->select('users.*', 'states.state', 'cities.city')
        ->first();
        
        $res = compact('sessions', 'cart', 'cartpayment', 'user', 'id');
        // return response()->json($res);
        // die;
         $res['title'] = 'Cancel Bookings';
       return view('admin.booking.cancel', $res);
    }
    public function cancel_booking_store(Request $request, $id){
        $request->validate([
            'remark' => 'required',
            'amount' => 'required'
            ]);
        $cart = Cart::where('id', $id)->first();
        $sessions = UserSession::where('cart_id', $id)->with('slot')->first();
        $data = [
            'user_id'  => $cart['user_id'],
            'expert_id' => $cart['expert_id'],
            'cart_id' => $id,
            'category_id' => $sessions['category_id'],
            'amount' => $request->amount,
            'remark' => $request->remark,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            ];
        $rfid = DB::table('refunds')->insert($data);
        if($rfid){
            Cart::where('id', $id)->update(['booking_status' => 'Cancelled']);
            Slot::where('cart_id', $id)->where('user_id', $cart['user_id'])->where('booking_status', 'Pending')->update(['booking_status' => 'Cancel']);
            UserSession::where('cart_id', $id)->where('status', '!=', 'Done')->update(['status' => 'Cancelled', 'refund_id' => $rfid, 'is_refunded' => '1']);
        }
          return redirect()->to('admin/sessions/all/all')->with('success', 'Updated successfully');
        
    }
    public function session_reports(){
        $title = "All Sessions Reports";
        $fdate = $_GET['fdate'] ?? null;
        $tdate = $_GET['tdate'] ?? null;
        // $items = UserSession::with('user:users.id,name,email,mobile,gender')
        // ->with('expert:id,name,email,mobile,profile_image')
        // ->with('slot:id,slot,slot_end,is_paid,booking_status,order_id')
        // ->with('cart:carts.id,carts.cca_response,payment_status,booking_status,for_me,base_amount,conven_fee,sub_cats,end_cats')
        // ->orderBy('user_sessions.created_at','DESC');
        // $sessions = $items->get();
        $items = Cart::where('payment_status', 'Success')
        ->with('expert:id,name,email,mobile,profile_image,designation')
        ->with('user:users.id,name,email,mobile,gender')
        ->withCount('all_pending_slot_sessions')
        ->withCount('closed_sessions')
        ->with('cart_payment')
        ->withCount('cancelled_sessions');
        if($fdate){
            $items->whereDate('created_at', '>=', $fdate);
        }
        if($tdate){
            $items->whereDate('created_at', '<=', $tdate);
        }
        $sessions = $items->orderBy('created_at', 'DESC')->get();
        // return response()->json($sessions);
        // die;
        $res = compact('title', 'sessions', 'fdate', 'tdate');
         return view('admin.reports.sessions_report', $res);
    }
    public function user_sessions(){
         $title = "All Sessions Reports";
        $fdate = $_GET['fdate'] ?? null;
        $tdate = $_GET['tdate'] ?? null;
        $items = UserSession::where('status', '=', 'Done')->with('user:users.id,name,email,mobile,gender')
        ->with('expert:id,name,email,mobile,profile_image,designation')
      
        ->with('slot:id,slot,slot_end,is_paid,booking_status,order_id')
        ->with('cart:carts.id,carts.cca_response,payment_status,booking_status,for_me,base_amount,conven_fee,sub_cats,end_cats,package_id')
        ->orderBy('user_sessions.apt_date','DESC');
        if($fdate){
            $items->where('apt_date', '>=', $fdate);
        }
        if($tdate){
            $items->where('apt_date', '<=', $tdate);
        }
        $sessions = $items->get();
        // return response()->json($sessions);
        // die;
         $res = compact('title', 'sessions', 'fdate', 'tdate');
         return view('admin.reports.user_sessions', $res);
        
    }
    
    public function open_slots(){
        $fdate = $_GET['fdate'] ?? null;
        $tdate = $_GET['tdate'] ?? null;
        $title = "Open Slots";
        $slots = Slot::whereNull('user_id')
        ->select('expert_id', DB::raw('count(*) as open_slots'))->with('expert:id,name,email,designation')
        ->orderBy('open_slots', 'DESC')->groupBy('expert_id');
        if($fdate){
            $slots->whereDate('slot', '>=', $fdate);
        }
        if($tdate){
            $slots->whereDate('slot', '<=', $tdate);
        }
        $items = $slots->get();
        $res = compact('title', 'items', 'fdate', 'tdate');
        // return response()->json($res);
        // die;
        return view('admin.reports.open_slots', $res);
    }
}
