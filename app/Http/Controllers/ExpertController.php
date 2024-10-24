<?php

namespace App\Http\Controllers;

use App\Mail\VerifiedExpert;

use App\Models\Category;
use App\Models\City;
use App\Models\ContactDetail;
use App\Models\Expert;
use App\Models\ExpertFee;
use App\Models\ExpertPoint;
use App\Models\ExpertRating;
use App\Models\ExpertCategory;
use App\Models\FindExpert;
use App\Http\AllTraits\MyTrait;
use App\Models\MobileOtp;
use App\Models\LeadPrice;
use App\Models\Language;
use App\Models\Lead;
use App\Models\Plan;
use App\Models\Policy;
use App\Models\Post;
use App\Models\Qualification;
use App\Models\Slot;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\ExpertSubCategory;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Exports\ExpertsExcel;
use App\Models\ExpertPhoto;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpertController extends Controller
{
    use MyTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/kolkata');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['title'] = 'List of Experts';
        $res['items'] = Expert::where('is_verified', '1')
            ->where('is_active', '1')
            ->join('posts', 'posts.id', '=', 'experts.post_id', 'left')
            ->with('state')->with('city')->with('expertize')->select(['experts.*', 'posts.post'])->orderBy('experts.created_at', 'DESC')->paginate(10);
        // return response()->json($res['items']);
        // die;
        return view('admin.experts.index', $res);
    }
    public function send_otps(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile'
        ]);
        if ($validation->fails()) {
            return response()->json(['success' => '0', 'errors' => $validation->errors(), 'message' => 'Invalid request credentials']);
        }
        $mdata = [
            'mobile' => $request->mobile,
            'otp' => rand(1111, 9999),
            'created_at' => date('Y-m-d H:i:s')
        ];
        MobileOtp::where(['mobile' => $request->mobile])->delete();
        DB::table('otps')->where(['email' => $request->email])->delete();
        MobileOtp::insert($mdata);
        $eotp = rand(1111, 9999);
        $email = $request->email;
        $edata = [
            'email' => $request->email,
            'otp' => $eotp,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('otps')->insert($edata);
        $mailData = [
            'subject' => 'Request to Verify Email',
            'body' =>  'Dear User your otp is ' . $eotp,
        ];
        return response()->json(['success' => '1', 'message' => 'OTP Send to your email.']);
        // if (Mail::to($email)->send(new CustomMail($mailData))) {
        //     return response()->json(['success' => '1', 'message' => 'OTP Send to your email.']);
        // } else {
        //     return response()->json(['success' => '0', 'message' => 'OTP Send to your email.']);
        // }
    }
    public function verify_otps(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email|exists:otps,email',
            'mobile' => 'required|unique:users,mobile|exists:mobile_otps,mobile',
            'mobileotp' => 'required|numeric|exists:mobile_otps,otp',
            'emailotp' => 'required|numeric|exists:otps,otp',
        ]);
        if ($validation->fails()) {
            return response()->json(['success' => '0', 'errors' => $validation->errors(), 'message' => 'Invalid request credentials']);
        } else {
            $edata = [
                'email' => $request->email,
                'otp' => $request->emailotp,
            ];
            $mdata = [
                'mobile' => $request->mobile,
                'otp' => $request->mobileotp,
            ];
            $isVerify = MobileOtp::where($mdata)->first();
            $everify = DB::table('otps')->where($edata)->first();
            if ($isVerify && $everify) {
                MobileOtp::where('id', $isVerify->id)->update(['is_verified' => '1']);
                DB::table('otps')->where('id', $everify->id)->update(['is_verified' => '1']);
                return response()->json(['success' => '1', 'message' => 'Otps verified successfully', 'data' => ['mobile' => $isVerify->id, 'email' => $everify->id]]);
            } else {
                return response()->json(['success' => '0', 'message' => 'Invalid otps']);
            }
        }
    }
    public function export()
    {
        return Excel::download(new ExpertsExcel, 'experts.xlsx');
    }
    public function pending_to_accept()
    {
        date_default_timezone_set('Asia/kolkata');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['title'] = 'List of Experts';
        $res['items'] = Expert::where('is_verified', '0')->with('category')->with('post')
            ->with('state')->with('city')->with('expertize')->orderBy('id', 'DESC')->get();
        // echo json_encode($res['items']);
        // die;
        return view('admin.experts.vpending', $res);
    }
    public function expert_verify($id)
    {
        date_default_timezone_set('Asia/kolkata');
        $expert = Expert::where('id', $id)->first();
        $user = User::where('uid', $id)->first();
        if ($user) {
            $password = $user['remember_token'];
        } else {
            $udata = [
                'uid' => $expert['id'],
                'name' => $expert->name,
                'email' => $expert->email,
                'mobile' => $expert->mobile,
                'password' => Hash::make('Edha@1234'),
                'remember_token' => 'Edha@1234',
                'designation' => 'Expert',
                'created_at' => date('Y-m-d H:i:s')
            ];
            User::insert($udata);
            $password = 'Edha@1234';
        }

        $mailData = [
            'title' => 'Account Verified Edha',
            'body' => 'Your Account has been Verified.',
            'userid' => $expert['email'],
            'name' => $expert['name'],
            'password' => $password
            // 'attachment' => public_path('upload/' . $item['resume'])
        ];
        Expert::where('id', $id)->update(['is_verified' => '1']);
        Mail::to($expert['email'])->send(new VerifiedExpert($mailData));
        return redirect()->back()->with('success', 'Veried successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'email' => 'required|exists:otps,id',
            'mobile' => 'required|exists:mobile_otps,id',
        ]);
        $res['expert'] = new Expert();
        $res['email'] = DB::table('otps')->where('id', $request->email)->first();
        $res['mobile'] = MobileOtp::where('id', $request->mobile)->first();
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['states'] = State::all();
        $res['cities'] = City::get();
        $res['categories'] = Category::all();
        $res['languages'] = Language::all();
        $res['positions'] = Post::get();
        $res['exps'] = SubCategory::all();
        $res['qualifications'] = Qualification::all();
        $res['mcat'] = 0;
        $res['charges'] = DB::table('Charges')->first();
        // return response()->json($res['charges']);
        // die;
        $check = User::where(['email' => $res['email']->email])->first();
        $checkm = User::where(['mobile' => $res['mobile']->mobile])->first();
        if ($check || $checkm) {
            return redirect()->route('expert.thankyou');
        } else {
            return view('frontend.expert.fill_details_form', $res);
        }
    }
    public function expert_reenter()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $validation = Validator::make($request->all(), [
            'password' => 'required',
            'pincode' => 'required',
            'file' => 'image|mimes:png,jpg,jpeg,svg|max:2048',
            'postname' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'pincode' => 'required',
            'language' => 'required',
            'pincode' => 'required',
            'therapy' => 'max:150',
            'stream' => 'max:150'
        ]);
        if ($validation->fails()) {
            $message = $validation->errors()->first();
            return response()->json(['data' => [], 'success' => '0', 'errors' => $validation->errors(), 'message' => $message]);
        }
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
            'mobile' => $request->mobile,
            'designation' => 0,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'stream' => $request->stream,
            'therapy' => $request->therapy,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'pincode' => $request->pincode,
            'post_id' => $request->postname,
            'modes' => implode(',', $request->mode),
            'custom_postname' => $request->custom_post_name,
            'languages' => implode(',', $request->language),
            'additional_details' => $request->additional_details,
            'is_verified' => '1',
            'created_at' => date('Y-m-d H:i:s')
        ];
        // echo json_encode($data);
        // die;
        $uid = Expert::insertGetId($data);
        foreach ($request->apply_for as $ap) {
            ExpertCategory::insert(['expert_id' => $uid, 'category_id' => $ap]);
        }
        if ($request->expertises) {
            foreach ($request->expertises as $ex) {
                ExpertSubCategory::insert(['expert_id' => $uid, 'sub_category_id' => $ex]);
            }
        }
        if ($request->language) {
            foreach ($request->language as $lang) {
                $lid = Language::where('language', $lang)->first();
                if ($lid) {
                    DB::table('expert_languages')->insert(['expert_id' => $uid, 'language_id' => $lid['id'],  'created_at' => date('Y-m-d H:i:s')]);
                }
            }
        }
        // $times = ['00:30:00', '01:00:00'];
        // foreach ($request->fee as $i => $fee) {
        //     ExpertFee::insert(['expert_id' => $uid, 'fee' => $fee, 'duration' =>  $times[$i], 'rate' => $request->rate, 'fixed_fee' => $request->fixed_fee]);
        // }

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

            return response()->json(['success' => '1', 'errors' => [], 'message' => 'Expert profile created successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function show(Expert $expert, $url)
    {
        date_default_timezone_set('Asia/kolkata');
        $sid = Session::getId();
        $check = FindExpert::where('session_id', $sid)->first();
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['expert'] = Expert::where('url', $url)->with('photos')->with(['reviews' => function ($q) {
            $q->where('show_web', '1');
        }])->with('post')->with('state')->with('city')->with('expertize')->orderBy('id', 'DESC')->first();
        if ($check) {
            $lead = Lead::where('search_id', $check->id)->first();
            $res['lead_id'] = $lead->id;
        } else {
            $res['lead_id'] = null;
        }

        return view('frontend.profile', $res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function edit(Expert $expert)
    {
        date_default_timezone_set('Asia/kolkata');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['user'] = User::where('id', Auth::user()->id)->first();
        $res['expert'] = Expert::where('id', Auth::user()->uid)->first();
        return view('frontend.expert.setting', $res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expert $expert)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'name' => 'required|min:4'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile
        ];
        $id = Auth::user()->id;
        $eid = Auth::user()->uid;
        if (Expert::where('id', $eid)->update($data)) {
            $data['password'] = Hash::make($request->password);
            User::where(['id' => $id, 'designation' => 'Expert'])->update($data);
        }
        return redirect()->back()->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expert  $expert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;
        $expert = Expert::where('id', $id)->first();
        $fdata = [
            'uid' => $id,
            'designation' => 'Expert'
        ];
        $udata = [
            'email' => 'terminated-' . $expert['id'],
            'is_active' => '0',
            'password' => md5('12345678signout')
        ];
        User::where($fdata)->update($udata);
        Expert::where('id', $id)->update(['is_active' => '0']);
        return redirect()->back()->with('success', 'Account Closed Successfully');
    }
    public function dashboard()
    {
        date_default_timezone_set('Asia/kolkata');

        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $eid = Auth::user()->uid;
        date_default_timezone_set('Asia/kolkata');
        $fdata = [
            'expert_id' => $eid,
            'booking_status' => 'Pending'
        ];
        $res['todays_session'] = Slot::whereDate('slot', date('Y-m-d'))->where($fdata)->where('is_paid', '1')->count();
        $res['open_sessions'] = Slot::whereDate('slot', '>', date('Y-m-d'))->where($fdata)->where('is_paid', '1')->count();
        $res['outdated_open_sessions'] = Slot::whereDate('slot', '<', date('Y-m-d'))->where($fdata)->where('is_paid', '1')->count();
        $res['completed_sessions'] = Slot::where(['expert_id' => $eid, 'booking_status' => 'done'])->where('is_paid', '1')->count();
        $res['expert'] = Expert::where('id', $eid)->with('expertize')->withCount('leads')
            ->withCount([
                'leads as confirmed_leads_count' => function ($query) {
                    $query->where('is_confirm', "1");
                }
            ])
            ->first();
        $res['points'] =  ExpertPoint::getBalancePoints();

        // echo json_encode($res['expert']);
        // die;
        $res['title'] = 'Expert Dashboard';
        return view('frontend.expert.dashboard', $res);
    }
    public function calendar()
    {
        //date_default_timezone_set('Asia/kolkata');
        $eid = $_GET['expert_id'] ?? null;
        $expert_id = Auth::user()->uid ?? base64_decode($eid);
        $isValid = Expert::where('id', $expert_id)->first();
        if (!$isValid) {
            return abort('403');
            die;
        }
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['title'] = 'Create Slots';
        $res['month'] = $_GET['month'] ?? date('Y-m');
        $res['t'] = date('t', strtotime($res['month']));
        $res['expert'] = $isValid;
        $items = Slot::where('expert_id', $isValid->id)->whereDate('slot', '>=', date('Y-m-d'))->get();
        $arr = [];
        foreach ($items as $item) {
            $mitem = [];
            $mitem['title'] = ($item['user_id']) ? ('Client') : ('Open');
            $mitem['start'] = $item['slot'];
            if ($item['slot_end']) {
                $mitem['end'] = $item['slot_end'];
            }
            $mitem['backgroundColor'] = ($item['is_paid'] == '1') ? ('#077773') : ('#F67C33');
            array_push($arr, $mitem);
        }
        $res['items'] = $arr;
        if (Auth::user()->designation == "Expert") {
            return view('frontend.expert.calendar', $res);
        }
        if (Auth::user()->designation == "Admin") {
            return view('admin.experts.calendar', $res);
        }
    }
    public function profile()
    {
        $title = "Reviews";
        $eid = auth()->user()->uid;
        $expert = Expert::where('id', $eid)->with('photos')->with(['reviews' => function ($q) {
            $q->where('show_web', '1');
        }])->first();

        $res = compact('title', 'expert');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        return view('frontend.expert.profile', $res);
    }
    public function reviews()
    {
        $title = "Reviews";
        $eid = auth()->user()->uid;
        $items = ExpertRating::where('expert_id', $eid)->get();

        $res = compact('title', 'items');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        return view('frontend.expert.reviews', $res);
    }
    public function save_reivew(Request $request)
    {
        // echo json_encode($request->all());
        // die;
        // $request->validate([
        //     'name' => 'required|min:3',
        //     'review' => 'required',
        //     'expert_id' => 'required|exists:experts,id'
        // ]);
        $data = [
            'expert_id' => $request->expert_id,
            'name' => $request->name,
            'review' => $request->review,
            'rating' => $request->rating,
            'created_at' => date('Y-m-d H:i:s')
        ];
        ExpertRating::insert($data);
        return redirect()->back()->with('success', 'Review saved successfully');
    }
    public function add_photos()
    {
        $title = "Add Photos";
        $eid = auth()->user()->uid;
        $photos = ExpertPhoto::where('expert_id', $eid)->get();

        $res = compact('title', 'photos');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        return view('frontend.expert.photos', $res);
    }
    public function save_photo(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg|max:2048'
        ]);
        $image = $request->file('image');
        $imageName = date('Ymdhis') . '_' . $image->getClientOriginalName();
        $image->move(public_path('/upload'), $imageName);
        $eid = auth()->user()->uid;
        $data = [
            'expert_id' => $eid,
            'image' => "public/upload/" . $imageName
        ];
        ExpertPhoto::insert($data);
        return redirect()->back()->with('success', 'Image saved successfully');
    }

    public function expert_close_request()
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['title'] = 'Expert Close Request';
        return view('frontend.expert.close', $res);
    }

    public function schedules($url = null, $time = null)
    {
        date_default_timezone_set('Asia/kolkata');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $mon = $res['month'] = $_GET['month'] ?? null;
        $items = Slot::where('is_paid', '1')->where('slots.expert_id', Auth::user()->uid)->with('expert:id,name,email,mobile')
            ->with('user')
            ->with('find_expert')
            ->join('user_sessions', 'user_sessions.slot_id', '=', 'slots.id')
            ->join('carts', 'carts.id', '=', 'slots.cart_id')
            ->join('cart_payments', 'cart_payments.cart_id', '=', 'slots.cart_id', 'left')
            ->join('find_experts', 'find_experts.session_id', '=', 'carts.session_id')
            ->join('categories', 'categories.id', '=', 'find_experts.category_id')
            ->where('cart_payments.cca_status', 'Success');
        if ($url != 'all') {
            $items->where('slots.booking_status', $url);
        }
        if ($time == 'today') {
            $items->whereDate('slot', '=', date('Y-m-d'));
        }
        if ($time == 'upcoming') {
            $items->whereDate('slot', '>', date('Y-m-d'));
        }
        if ($time == 'outdated') {
            $items->whereDate('slot', '<', date('Y-m-d'));
        }
        if ($mon) {
            $items->whereMonth('slot', '=', date('m', strtotime($mon)));
        }
        if ($mon) {
            $items->whereYear('slot', '=', date('Y', strtotime($mon)));
        }
        $res['url'] = $url;
        $res['time'] = $time;
        $res['expert'] = Auth()->user();
        $res['slots'] = $items->select(['slots.*', 'categories.category', 'find_experts.sub_cats', 'find_experts.end_cats', 'user_sessions.id as usid', 'user_sessions.status as meeting_status', 'cart_payments.base_amount'])->orderBy('slot', 'DESC')->paginate(20)->withQueryString();
        $res['title'] = 'List of Schedules';
        // $res['exportItems'] = $items->select(['slots.*', 'categories.category', 'find_experts.sub_cats', 'find_experts.end_cats', 'user_sessions.id as usid'])->orderBy('slot', 'DESC')->get();
        // echo json_encode($res['slots']);
        // die;
        // return response()->json($res['slots']);
        // die;
        return view('frontend.expert.slots', $res);
    }
    public function expert_edit()
    {
        date_default_timezone_set('Asia/kolkata');
        $res['title'] = 'Expert Edit';
        // echo $_GET['expert_id'];
        // die;
        $eid = Auth::user()->designation == "Expert" ? Auth::user()->uid : base64_decode($_GET['expert_id']);
        // echo Auth::user()->designation;
        // die;
        $isValidEid = $res['expert'] = Expert::where('id', $eid)->first();

        if (!$isValidEid) {
            return abort('403');
            die;
        }
        $res['states'] = State::orderBy('state', 'ASC')->get();
        $res['cities'] = City::where('state_id', $res['expert']['state_id'])->get();
        $res['qualifications'] = Qualification::all();
        $res['categories'] = Category::all();
        $res['languages'] = Language::all();
        $res['mcat'] = $res['expert']['designation'];
        $res['positions'] = Post::where('category_id', $res['mcat'])->get();
        $res['exps'] = SubCategory::where('category_id', $res['mcat'])->get();
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['fee_30'] = ExpertFee::where(['expert_id' => $eid, 'duration' => '00:30:00'])->first();
        $res['fee_60'] = ExpertFee::where(['expert_id' => $eid, 'duration' => '01:00:00'])->first();
        $exps = ExpertSubCategory::where('expert_id', $eid)->select('sub_category_id')->get();
        $res['charges'] = DB::table('Charges')->where('category_id', $res['expert']['designation'])->first();
        $res['ecats'] = ExpertCategory::where('expert_id', $eid)->pluck('category_id')->all();
        // echo json_encode($res['ecats']);
        // die;
        $res['expsz'] = [];
        foreach ($exps as $ex) {
            array_push($res['expsz'], $ex['sub_category_id']);
        }
        // echo json_encode($res['exps']);
        // die;
        if (Auth::user()->designation == "Expert") {
            return view('frontend.expert.edit', $res);
        }
        if (Auth::user()->designation == "Admin") {
            return view('admin.experts.edit', $res);
        }
    }
    public function mark_completed(Request $request, $id)
    {
        $data = [
            'status' => 'Done'
        ];
        $session = UserSession::where('id', $id)->first();
        if (UserSession::where('id', $id)->update($data)) {

            Slot::where('id', $session['slot_id'])->update(['booking_status' => 'Done']);
            if ($request->ajax()) {
                return true;
            } else {
                return redirect()->back()->with('success', 'Marked Done');
            }
        }
    }
    public function expert_update_admin(Request $request, $id)
    {
        date_default_timezone_set('Asia/kolkata');
        $user = User::where(['uid' => $id, 'designation' => 'Expert'])->first();
        $user_id = $user['id'];
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user_id,
            'mobile' => 'required|unique:users,mobile,' . $user_id,
            'pincode' => 'required',
            'fee' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'mode' => 'required',
            'language' => 'required',
            'pincode' => 'required',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
        } else {
            $file_name = $request->hfile;
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'profile_image' => $file_name,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'stream' => $request->stream,
            'therapy' => $request->therapy,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'pincode' => $request->pincode,
            'modes' => implode(',', $request->mode),
            'languages' => implode(',', $request->language),
            'additional_details' => $request->additional_details,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Expert::where('id', $id)->update($data);
        $udata = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        User::where(['uid' => $id, 'designation' => 'Expert'])->update($udata);

        if ($request->expertises) {
            ExpertSubCategory::where('expert_id', $id)->delete();
            foreach ($request->expertises as $ex) {
                ExpertSubCategory::insert(['expert_id' => $id, 'sub_category_id' => $ex]);
            }
        }
        $times = ['00:30:00', '01:00:00'];
        ExpertFee::where('expert_id', $id)->delete();
        foreach ($request->fee as $i => $fee) {
            ExpertFee::insert(['expert_id' => $id, 'fee' => $fee, 'duration' => $times[$i]]);
        }
        return redirect()->back()->with('success', 'Updated successfully');
    }
    public function expert_update(Request $request, $id)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([

            'postname' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'pincode' => 'required',
            'mode' => 'required',
            'language' => 'required'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
        } else {
            $file_name = $request->hfile;
        }
        $data = [
            'profile_image' => $file_name,
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
            'updated_at' => date('Y-m-d H:i:s')
        ];
        Expert::where('id', $id)->update($data);
        if ($request->expertises) {
            ExpertSubCategory::where('expert_id', $id)->delete();
            foreach ($request->expertises as $ex) {
                ExpertSubCategory::insert(['expert_id' => $id, 'sub_category_id' => $ex]);
            }
        }
        if ($request->apply_for) {
            ExpertCategory::where('expert_id', $id)->delete();
            foreach ($request->apply_for as $ap) {
                ExpertCategory::insert(['expert_id' => $id, 'category_id' => $ap]);
            }
        }
        return redirect()->back()->with('success', 'Updated successfully');
    }
    public function leads()
    {
        $title = " List of Leads ";
        $policies = Policy::all();
        $socials = ContactDetail::where('type', 'social')->get();

        $items = Lead::whereIn('id', function ($q) {
            $q->from('expert_points')->where('expert_id', auth()->user()->uid)->where('is_confirm', '0')->select('lead_id');
        })->with('search_data')->with('is_assigned')->withCount('assigns')->withCount('assigns_confirm')->orderBy('id', 'DESC')->get();
        $res = compact('items', 'title', 'policies', 'socials');
        // return response()->json($items);
        // die;
        return view('frontend.expert.leads', $res);
    }
    public function myleads()
    {
        $title = " List of My Leads ";
        $policies = Policy::all();
        $socials = ContactDetail::where('type', 'social')->get();

        $items = Lead::whereIn('id', function ($q) {
            $q->from('expert_points')->where('expert_id', auth()->user()->uid)->where('is_confirm', '1')->select('lead_id');
        })->with('search_data')->with('is_assigned')->orderBy('id', 'DESC')->get();
        $res = compact('items', 'title', 'policies', 'socials');
        // return response()->json($items);
        // die;
        return view('frontend.expert.myleads', $res);
    }
    public function assign_lead(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id'
        ]);
        $lead_id = $request->lead_id;
        $lead = Lead::where('id', $lead_id)->with('search_data')->first();
        $category_id = $lead->search_data->category_id;
        $lead_charge =  LeadPrice::where('category_id', $category_id)->first();
        $charges = $lead_charge->points;
        $pointdata = ExpertPoint::getBalancePoints();
        $balance = $pointdata['balance'];
        if ($balance < $charges) {
            return response()->json(['success' => '0', 'message' => 'Insufficient balance',  'errors' => ['balance' => ['insufficient balance']]]);
        } else {
            $data = [
                'lead_id' => $lead_id,
                'expert_id' => auth()->user()->uid,
                'is_confirm' => "0"
            ];
            $udata = [
                'is_confirm' => "1",
                "type" => "Debit",
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
            ExpertPoint::where($data)->update($udata);
            Lead::where('id', $lead_id)->update(['request_sent' => '1']);
            return response()->json(['success' => '1', 'errors' => []]);
        }
    }
    public function plans()
    {
        $title = "List of plans";
        $policies = Policy::all();
        $plans = Plan::all();
        $socials = ContactDetail::where('type', 'social')->get();
        $res = compact('title', 'policies', 'socials', 'plans');
        return view('frontend.expert.plans', $res);
    }
    public function purchase_plan(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id'
        ]);
        $plan_id = $request->plan_id;
        $user = auth()->user()->uid;
        $plan = Plan::where('id', $plan_id)->first();
        $orderId = "ORDER" . Carbon::now()->format('Ymdhis');
        $data = [
            "order_id" => $orderId,
            'plan_id' => $plan_id,
            'expert_id' => $user,
            'amount' => $plan->amount,
            'points' => $plan->points,
            'is_confirm' => "1",
            "type" => "Credit",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        ExpertPoint::insert($data);
        return redirect()->back()->with('Success', 'Plan purchased successfully');
    }
    public function expert_wallet()
    {
        $title = "List of wallet";
        $items = ExpertPoint::where('expert_id', auth()->user()->uid)->where('is_confirm', '1')->orderByRaw('COALESCE(updated_at, created_at) ASC')->get();
        $policies = Policy::all();
        $socials = ContactDetail::where('type', 'social')->get();
        $res = compact('title', 'policies', 'socials', 'items');
        return view('frontend.expert.transactions', $res);
    }
    public function show_lead_details(Request $request)
    {
        $id = $request->id;

        $lead = Lead::where('id', $id)->first();
        $ep = ExpertPoint::where('expert_id', auth()->user()->uid)->where('lead_id', $id)->first();

        $email = $lead->email;

        $email_parts = explode('@', $email);

        $masked_email = substr($email_parts[0], 0, 2) . 'xxx@' . $email_parts[1];
        $mobile = $lead->mobile;
        $maskedMobile = substr($mobile, 0, 3) . 'xxx';

        $search_data = FindExpert::where('id', $lead->search_id)->with('state_name')->with('city_name')->first();
        if ($ep->is_confirm == "0") {
            $search_data->email = $masked_email;
            $search_data->mobile = $maskedMobile;
        }
        if ($ep->is_confirm == "1") {
            $search_data->email = $lead->email;
            $search_data->mobile  = $lead->mobile;
        }

        $search_data->name = $lead->name;

        return response()->json($search_data);
    }
}