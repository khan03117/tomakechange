<?php

namespace App\Http\Controllers;

use App\Mail\SignupMailExpert;
use App\Mail\SingupMailAdmin;
use App\Mail\CustomMail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactDetail;
use App\Models\City;
use App\Models\Gallery;
use App\Models\Expert;
use App\Models\Faq;
use App\Models\FindExpert;
use App\Models\JoinRequest;
use App\Models\Language;
use App\Models\Lead;
use App\Models\MobileOtp;
use App\Models\Qualification;
use App\Models\Service;
use App\Models\State;
use App\Models\User;
use App\Models\ExpertFee;
use App\Models\Package;
use App\Models\Policy;
use App\Models\Slot;
use App\Models\SlotTimeGap;
use App\Models\SubCategory;
use App\Models\Video;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\AllTraits\MyTrait;
use App\Models\ExpertPoint;
use App\Models\LeadPrice;
use Carbon\Carbon;

class HomeController extends Controller
{
    use MyTrait;
    public function index()
    {

        date_default_timezone_set('Asia/kolkata');
        Session::regenerate();
        $res['videos'] = Video::orderBy('id', 'DESC')->limit(3)->get();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $res['blogs'] = Blog::orderBy('id', 'DESC')->limit(3)->get();
        $res['faqs'] = Faq::orderBy('id', 'DESC')->limit(5)->get();
        $res['title'] = "Edha I Online Counselling & Therapy";
        $res['categories'] = Category::with('subcategory')->get();
        $res['profileImages'] = Expert::select('profile_image')->where('is_active', '1')->inRandomOrder()->get();
        $res['states'] = State::all();
        $res['langs'] = Language::all();

        return view('frontend.index', $res);
    }
    public function faqs()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $res['faqs'] = Faq::orderBy('id', 'DESC')->get();

        return view('frontend.faqs', $res);
    }
    public function about()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.about', $res);
    }
    public function counsellers()
    {
        date_default_timezone_set('Asia/kolkata');
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $sid = Session::getId();
        $check = FindExpert::where('session_id', $sid)->first();
        $res['title'] = "edha : Online Counseling Platform ";
        if ($check) {
            $langs = explode(',', $check['languages']);

            $lead = Lead::where('search_id', $check->id)->first();
            if (!$lead) {
                return redirect()->back();
            }
            $scats = json_decode($check['sub_cats']);
            $sids = [];
            foreach ($scats as $cat) {
                array_push($sids, $cat->id);
            }


            if ($check['category_id'] == '1') {
                $res['dtls'] = $check;
                $cH = date('H');
                $ch = $cH . ':00:00';

                $cgap = SlotTimeGap::where('current_hour', $ch)->first();

                $gap = $cgap['hour_gap'];
                $date = date('Y-m-d H:i:s', strtotime("+{$gap} hours"));

                $res['title'] = 'List of Experts';
                $res['states'] = State::orderBy('state', 'ASC')->get();
                $items = Expert::with('state')->where('is_active', '1')->with('city');
                if (count($sids) > 0) {
                    $items->whereIn('experts.id', function ($q) use ($sids) {
                        $q->select('expert_id')->from('expert_sub_categories')->whereIn('sub_category_id', $sids);
                    });
                }

                $items->whereIn('experts.id', function ($q) use ($langs) {
                    $q->select('expert_id')->from('expert_languages')->whereIn('language_id', function ($b) use ($langs) {
                        $b->select('id')->from('languages')->whereIn('language', $langs);
                    });
                });
                $items->with('expertize')->with('fee')->where('designation', '1')
                    ->where('is_verified', '1')
                    ->where('is_active', '1')
                    ->withCount('slots')
                    ->orderBy('slots_count', 'DESC');
                // return response()->json($items->get());
                // die;
                $res['items'] = $items->get();
                $res['lead_id'] = $lead->id;
                $res['search_id'] = $check->id;
                return view('frontend.counsellers', $res);
            } else if ($check['category_id'] == '2') {
                return redirect()->to('coaches');
            } else if ($check['category_id'] == '3') {
                return redirect()->to('self-help');
            }
        } else {
            return redirect()->to('find-expert');
        }
    }
    public function coaches()
    {
        $sid = Session::getId();
        $check = FindExpert::where('session_id', $sid)->first();

        if ($check) {
            if ($check['category_id'] == '2') {
                $langs = explode(',', $check['languages']);
                $scats = json_decode($check['sub_cats']);
                $sids = [];
                foreach ($scats as $cat) {
                    array_push($sids, $cat->id);
                }
                $res['socials'] = ContactDetail::where('type', 'social')->get();
                $res['policies'] = Policy::all();
                $res['title'] = 'Talk to our coaches';
                $items = Expert::where('designation', '=', '2')->where('is_active', '1')->where('is_verified', '1')
                    ->join('posts', 'posts.id', '=', 'experts.post_id', 'left')->with('fee');

                $items->whereIn('experts.id', function ($q) use ($sids) {
                    $q->select('expert_id')->from('expert_sub_categories')->whereIn('sub_category_id', $sids);
                });
                $items->whereIn('experts.id', function ($q) use ($langs) {
                    $q->select('expert_id')->from('expert_languages')->whereIn('language_id', function ($b) use ($langs) {
                        $b->select('id')->from('languages')->whereIn('language', $langs);
                    });
                });
                $items->select(['experts.id', 'experts.url', 'name', 'languages', 'custom_postname', 'modes', 'profile_image', 'designation', 'qualification', 'experience', 'state_id', 'city_id', 'posts.post'])
                    ->with('state')->with('city')->with('expertize')->with('fee');
                $res['items'] = $items->get();
                $res['search_id'] = $check->id;
                $res['title'] = "edha : Online Coaching Platform for personal growth";
                return view('frontend.coaches-1', $res);
            } else if ($check['category_id'] == '1') {
                return redirect()->to('counsellers');
            } else if ($check['category_id'] == '3') {
                return redirect()->to('self-help');
            }
        } else {
            return redirect()->to('find-expert');
        }
    }
    public function self_heleper()
    {
        $sid = Session::getId();
        $check = FindExpert::where('session_id', $sid)->first();
        if ($check) {
            if ($check['category_id'] == '3') {
                $langs = explode(',', $check['languages']);
                $scats = json_decode($check['sub_cats']);
                $sids = [];
                foreach ($scats as $cat) {
                    array_push($sids, $cat->id);
                }
                $res['socials'] = ContactDetail::where('type', 'social')->get();
                $res['policies'] = Policy::all();

                $res['title'] = 'Talk to Self Help Team';
                $items = Expert::where('designation', '=', '3')
                    ->where('is_active', '1')
                    ->where('is_verified', '1')->with('state:id,state')
                    ->with('city:id,city')->with('expertize:id,sub_category')
                    ->join('posts', 'posts.id', '=', 'experts.post_id', 'left')
                    ->with('postname')
                    ->with('fee')->orderBy('id', 'DESC')
                    ->select(['experts.id', 'experts.url', 'name', 'languages', 'custom_postname', 'modes', 'profile_image', 'designation', 'qualification', 'experience', 'state_id', 'city_id', 'posts.post']);

                // $items->whereIn('experts.id', function($q) use ($sids){
                //     $q->select('expert_id')->from('expert_sub_categories')->whereIn('sub_category_id', $sids);
                // });
                $items->whereIn('experts.id', function ($q) use ($langs) {
                    $q->select('expert_id')->from('expert_languages')->whereIn('language_id', function ($b) use ($langs) {
                        $b->select('id')->from('languages')->whereIn('language', $langs);
                    });
                });
                // echo json_encode($res['items']);
                // die;
                $res['items'] = $items->get();
                return view('frontend.coaches-1', $res);
            } else if ($check['category_id'] == '1') {
                return redirect()->to('counsellers');
            } else if ($check['category_id'] == '2') {
                return redirect()->to('coaches');
            }
        } else {
            return redirect()->to('find-expert');
        }
    }
    public function test()
    {

        return view('frontend.test');
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'

        ]);
        $email = $request->email;

        if (DB::table('subscribers')->insert(['email' => $request->email, 'created_at' => date('Y-m-d')])) {
            $mailData = [
                'subject' => 'Request for Subscription',
                'body' => '<p>Please add ' . $email . ' for subscription </p>'
            ];
            if (Mail::to('ask@edha.life')->send(new CustomMail($mailData))) {
                return redirect()->to('subscribe')->with('success', 'Subscribed Successfully');
            }
        }
    }
    public function subscribe_show()
    {
        $res['title'] = 'Thank you';
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $res['message'] = '<h4>Thank you for subscribing.</h4>';
        return view('frontend.thankyou', $res);
    }
    public function contact()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.contact', $res);
    }
    public function blogs()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();

        $res['blogs'] = Blog::with('subcategory')->orderBy('id', 'DESC')->get();
        // echo "<pre>";
        // echo json_encode($res['blogs']);
        // die;

        return view('frontend.blog', $res);
    }
    public function show_blog($url)
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();

        $res['policies'] = Policy::all();
        $res['blog'] = Blog::where('url', $url)->first();
        View::share('meta_key', $res['blog']['meta_key']);
        View::share('meta_desc', $res['blog']['meta_desc']);
        return view('frontend.single-blog', $res);
    }

    public function videos()
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['items'] = Video::orderBy('id', 'DESC')->get();
        return view('frontend.videos', $res);
    }
    public function ask()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.ask', $res);
    }
    public function opening_position()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.opening_position', $res);
    }
    public function forgot_password()
    {
        $res['title'] = 'Forgot Password';
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.forgot_password', $res);
    }
    public function eep()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.eep', $res);
    }
    public function mental_health_assessments()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.mental_health_assessments', $res);
    }
    public function mental_health_contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'concern' => 'required',
        ]);

        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $concern = $request->input('concern');


        Mail::to('ask@edha.life')->send(new \App\Mail\ContactMail($name, $mobile, $concern));

        return redirect()->route('mental_health_assessments')->with('message', 'Thank you for contacting us!');
    }
    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|numeric',
            'message' => 'required',
        ]);

        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $message = $request->input('message');


        Mail::to('ask@edha.life')->send(new \App\Mail\ContactMail($name, $mobile, $message));

        return redirect()->route('counselling')->with('message', 'Thank you for contacting us!');
    }
    public function expert_talk()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.expert-talk', $res);
    }
    public function mediation()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.mediation', $res);
    }
    public function csr()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $res['title'] = 'edha foundation';
        $res['items'] = Gallery::where(['type' => 'foundation', 'is_shown' => '1'])->get();
        return view('frontend.csr', $res);
    }
    public function sprituality()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.sprituality', $res);
    }
    public function expert_join()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        return view('frontend.expert_join', $res);
    }
    public function join_as()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $res['title'] = 'Join As';
        return view('frontend.join-as', $res);
    }
    public function signup()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $res['states'] = State::all();
        $res['qitems'] = Qualification::all();
        $res['cats'] = Category::all();
        return view('frontend.singup', $res);
    }
    public function signup_user()
    {
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $res['title'] = "Sign Up ";
        return view('frontend.user.sign-up', $res);
    }
    public function signup_user_store(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|min:10|max:10|unique:users,mobile'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'remember_token' => $request->password,
            'designation' => 'User',
            'created_at' => now()
        ];
        $uid = User::insertGetId($data);
        if (Auth::attempt(['id' => $uid, 'password' => $request->password])) {
            return redirect()->to('user/dashboard');
        }
    }
    public function login()
    {
        if (Auth::user()) {
            $user = Auth::user()->designation;

            if ($user == 'Expert') {
                $expert = Expert::where('id', Auth::user()->uid)->first();
                if ($expert['is_verified'] == '1') {
                    return redirect()->route('expert.dashboard');
                } else {
                    session()->flush();
                    return redirect()->back()->withInput();
                }
            }
            if ($user == 'User') {
                return redirect()->route('user.dashboard');
            }
            if ($user == 'Admin') {
                session()->flush();
                return redirect()->back()->withInput();
            }
        }
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        return view('frontend.login', $res);
    }
    public function login_auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $cred = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => '1',
        ];

        if (Auth::attempt($cred)) {

            $user = Auth::user()->designation;

            if ($user == 'Expert') {
                $expert = Expert::where('id', Auth::user()->uid)->first();
                if ($expert['is_verified'] == '1') {
                    return redirect()->route('expert.dashboard');
                } else {
                    session()->flush();
                    return redirect()->back()->withInput();
                }
            }
            if ($user == 'User') {
                return redirect()->route('user.dashboard');
            }
            if ($user == 'Admin') {
                session()->flush();
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->back()->withInput();
        }
    }
    public function find_expert()
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $sid = Session::getId();
        $check = FindExpert::where('session_id', $sid)->first();
        if (!$check) {
            $res['q1'] = $_GET['q1'] ?? null;
            $res['qcat1'] = Category::where('category', $res['q1'])->first();
            if (!$res['qcat1']) {
                $res['qcat1'] = ['id' => null];
            }
            $res['categories'] = Category::with('subcategory')->get();
            // echo json_encode($res);
            // die;
            $res['states'] = State::all();
            $res['langs'] = Language::all();
            if (Auth::user()) {
                $res['last_find'] = FindExpert::where('cart_id', function ($q) {
                    $q->from('carts')->select('id')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->limit(1);
                })->first();

                $res['cities'] = City::where('state_id', Auth::user()->state_id)->get();
            } else {
                $res['cities'] = City::where('state_id', '0')->get();
                $res['last_find'] = FindExpert::where('cart_id', '0')->first();
            }
            $res['lang_arr'] = $res['last_find'] ? $res['last_find']['languages'] : '';

            return view('frontend.find-expert', $res);
        } else {
            if ($check['category_id'] == '1') {
                return redirect()->to('counsellers');
            }
            if ($check['category_id'] == '2') {
                return redirect()->to('coaches');
            }
            if ($check['category_id'] == '3') {
                return redirect()->to('self-help');
            }
        }
    }
    public function signup_store(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|min:10|max:10|unique:users,mobile',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'qualification' => 'required',
            'apply_for' => 'required',
            // 'file' => 'required|mimes:pdf,docx,doc|max:2048',
            // 'aadhar_back_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'aadhar_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //Resume
        $file = $request->file('file');
        $filename = time() . $file->getClientOriginalName();
        $file->move(public_path('upload/'), $filename);

        $image = $request->file('aadhar_back_img');
        $imagename = time() . $image->getClientOriginalName();
        $image->move(public_path('upload/'), $imagename);

        //Aadhar Image
        $aimage = $request->file('aadhar_image');
        $aimagename = time() . $aimage->getClientOriginalName();
        $aimage->move(public_path('upload/'), $aimagename);
        $email = $request->email;

        $data = [
            'uuid' => Str::uuid(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'state' => $request->state,
            'city' => $request->city,
            'qualification' => $request->qualification,
            'apply_for' => $request->apply_for,
            'experience' => $request->experience,
            'notice_period' => $request->notice_period,
            'frequency' => $request->frequency,
            'per_day_hour' => $request->per_day_hour,
            'post' => $request->role,
            'custom_post' => $request->post_name,
            'resume' => $filename,
            'aadhar_back_img' => $imagename,
            'aadhar_image' => $aimagename,
            'stream' => $request->stream,
            'pincode' => $request->pincode,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (JoinRequest::insert($data)) {
            $maildata = [
                'name' => $request->first_name . ' ' . $request->last_name
            ];
            Mail::to($email)->send(new SignupMailExpert($maildata));

            $maildata = [
                'attachment' => public_path('upload/' . $filename)
            ];
            $maildata['user'] = $data;
            Mail::to(env('MAIL_RECEIVED'))->send(new SingupMailAdmin($maildata));
            $res['title'] = 'Thank you';
            $res['socials'] = ContactDetail::where('type', 'social')->get();
            $res['policies'] = Policy::all();
            $res['message'] = '<p>We shall get back to you shortly</p>';
            return view('frontend.thankyou', $res);
        }
    }
    public function find_expert_save(Request $request)
    {
        // echo json_encode($request->all());
        // die;
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'category_id' => 'required',
            'subcats' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'contact_mode' => 'required',
            'langs' => 'required',

        ]);
        $cid = $request->category_id;
        $sids = $request->subcats;

        $subcats = SubCategory::whereIn('id', $sids)->select(['sub_category', 'id'])->get();



        $data = [
            'for_me' => $request->is_for_me,
            'for_whome' => $request->for_whome,
            'session_id' => (string) Session::getId(),
            'category_id' => $cid,
            'sub_cats' => json_encode($subcats),
            'languages' => implode(',', $request->langs),
            'contact_mode' => $request->contact_mode,
            'pincode' => $request->pincode,
            'city' => $request->city,
            'state' => $request->state,
            'age_group' => $request->age_group,
            'contact_mode' => $request->contact_mode,
            'how_soon' => $request->how_soon,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $fid =  FindExpert::insertGetId($data);
        $udata = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'search_id' => $fid,
            'created_at' => date('Y-m-d H:i:s')
        ];
        Lead::insert($udata);
        if ($cid == 1) {
            return redirect()->to('counsellers');
        } else if ($cid == 2) {
            return redirect()->to('coaches');
        } else if ($cid == 3) {
            return redirect()->to('self-help');
        }
    }
    public function logout()
    {
        //Auth::logout();
        session()->flush();
        return redirect()->to('');
    }
    public function counselling(Request $request)
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        // $res['title'] = 'Counselling';
        $res['slug'] = $request->slug ?? 'counselling';

        $res['items'] = Service::where([['category_id', '=', '1'], ['url', '=', $request->slug ?? 'counselling']])->get();
        return view('frontend.counselling', $res);
    }
    public function coaching()
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['title'] = 'Counselling';
        $res['items'] = Service::where('category_id', '=', '2')->get();
        return view('frontend.coaching', $res);
    }
    public function book_now($url)
    {
        $sid = Session::getId();
        $check1 = FindExpert::where('session_id', $sid)->first();
        if ($check1) {
            date_default_timezone_set('Asia/kolkata');
            $res['policies'] = Policy::all();
            $res['socials'] = ContactDetail::where('type', 'social')->get();
            $sid = Session::getId();
            $check = FindExpert::where('session_id', $sid)->first();
            if (Auth::user()) {
                if (Auth::user()->designation == 'Expert') {
                    return redirect()->to('logout');
                }
                $res['user'] = User::where('id', Auth::user()->id)->first();
            } else {
                $res['user'] = new User();
            }

            if ($check) {
                $res['states'] = State::orderBy('state', 'ASC')->get();
                $res['dtls'] = $check;

                if ($check['category_id'] == '1') {
                    $burl = 'counsellers';
                }
                if ($check['category_id'] == '2') {
                    $burl = 'coaches';
                }
                if ($check['category_id'] == '3') {
                    $burl = 'self-help';
                }
                $res['burl'] = $burl;

                $res['cities'] = City::where('state_id', $check['state'])->get();
                $res['expert'] = $exp = Expert::where('url', $url)->with('category')->with('post')->with('expertize')->with('fee')->with('state')->with('city')->first();
                $res['f_fee'] = $fee = ExpertFee::where('expert_id', $exp['id'])->where('is_active', '1')->first();
                $res['slots'] = Slot::where('expert_id', $exp['id'])
                    ->whereDate('slot', date('Y-m-d', strtotime('+1 Days')))
                    ->where('is_paid', '0')
                    ->whereTime('slot', '>', date('H:i:s'))
                    ->get();
                $res['items'] = Package::where('duration', $fee['duration'])->orderBy('quantity', 'ASC')->get();
                return view('frontend.book-now', $res);
            } else {
                return redirect()->to('find-expert');
            }
        } else {
            return redirect()->to('find-expert');
        }
    }
    public function policy($url)
    {
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policy'] = Policy::where('url', $url)->first();
        return view('frontend.policy', $res);
    }
    public function success_registration($id)
    {

        $res['title'] = 'Success';
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['policies'] = Policy::all();
        $item = JoinRequest::where('id', $id)->first();
        if ($item['is_created'] == '1') {
            return view('frontend.success_reg', $res);
        }
    }
    public function save_ask(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:200',
            'mobile' => 'required|min:10|max:13',
            'message' => 'nullable|max:300'
        ]);
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $time = $request->time;
        $msg = $request->message;
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'call_time' => $request->time,
            'message' => $request->message,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $output = '<table border="1" style="max-width:500px;border-collapse:collapse;table-layout:fixed;">';
        $output .= "<tbody>
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                {$name}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                {$email}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mobile
                            </td>
                            <td>
                                {$mobile}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Call Time
                            </td>
                            <td>
                                {$time}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Message
                            </td>
                            <td>
                                {$msg}
                            </td>
                        </tr>
                    </tbody></table>";
        $mailData = [
            'subject' => 'New Query Received.',
            'body' => $output
        ];
        Mail::to('ask@edha.life')->send(new CustomMail($mailData));
        if (DB::table('contact_queries')->insert($data)) {
            $res['title'] = 'Thank you';
            $res['socials'] = ContactDetail::where('type', 'social')->get();
            $res['policies'] = Policy::all();
            $res['message'] = '<p>Thank you for contacting. </p><p>We shall get back to you  shortly.</p>';
            return view('frontend.thankyou', $res);
        }
    }
    public function send_callback_request(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'expert_id' => 'required|exists:experts,id'
        ]);
        $lead_id = $request->lead_id;
        $lead = Lead::where('id', $lead_id)->with('search_data')->first();
        $category_id = $lead->search_data->category_id;
        $lead_charge =  LeadPrice::where('category_id', $category_id)->first();
        $charges = $lead_charge->points;
        $orderId = "ORDER" . Carbon::now()->format('YmdHis');
        $countSent = ExpertPoint::where([
            'lead_id' => $lead_id,
        ])->count();
        if ($countSent < 4) {
            $data = [
                "order_id" => $orderId,
                'lead_id' => $lead_id,
                'expert_id' => $request->expert_id,
                'points' => $charges,
                'is_confirm' => "0",
                "type" => "Debit",
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
            $isAlready = ExpertPoint::where([
                'lead_id' => $lead_id,
                'expert_id' => $request->expert_id,
            ])->first();
            if (!$isAlready) {
                ExpertPoint::insert($data);
            }
            return response()->json(['success' => '1', 'errors' => []]);
        } else {
            return response()->json(['success' => '0', 'errors' => []]);
        }
    }
    public function send_otp(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'mobile' => 'required|min:10|max:10'
        ]);
        $otp = rand(1111, 9999);
        $data = [
            'mobile' => $request->mobile,
            'otp' => $otp,
            'is_verified' => '0',
            'created_at' => date('Y-m-d H:i:s')
        ];
        MobileOtp::where(['mobile' => $request->mobile, 'is_verified' => '0'])->delete();
        MobileOtp::insert($data);
        return response()->json(['success' => '1', 'errors' => []]);
    }
    public function verify_otp(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $validate = Validator::make($request->all(), [
            'mobile' => 'required|min:10|max:10|exists:mobile_otps,mobile',
            'otp' =>  'required|min:4|max:4|exists:mobile_otps,otp',
        ]);
        if ($validate->fails()) {
            return response()->json(['success' => '0', 'errors' => $validate->errors()]);
        } else {
            $mobile = $request->mobile;
            $otp = $request->otp;
            $udata =  ['mobile' => $mobile, 'otp' => $otp];
            $isExists = MobileOtp::where($udata)->first();
            if ($isExists) {
                MobileOtp::where($udata)->update(['is_verified' => '1']);
                return response()->json(['success' => '1', 'errors' => []]);
            } else {
                return response()->json(['success' => '0', 'errors' => []]);
            }
        }
    }
}