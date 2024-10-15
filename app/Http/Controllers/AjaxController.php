<?php

namespace App\Http\Controllers;

use App\Models\CartPayment;
use App\Models\City;
use App\Models\EndCategory;
use App\Models\ExpertFee;
use App\Models\Package;
use App\Models\Post;
use App\Mail\CustomMail;
use App\Models\Chat;
use App\Models\Slot;
use App\Models\SlotTimeGap;
use App\Models\State;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Expert;
use Illuminate\Support\Facades\Hash;
use App\Models\SubCategory;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class AjaxController extends Controller
{
    public function get_sub_category(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;
        $items = SubCategory::where('category_id', $id)->get();
        $output = '<option value="">---select---</option>';
        foreach ($items as $item) {
            $output .= '<option value="' . $item['id'] . '">' . $item['sub_category'] . '</option>';
        }
        return $output;
    }
    public function get_mobile_number(Request $request)
    {
        $request->validate([
            'key' => 'required'
        ]);
        $key = $request->key;
        $data = [
            'email' => $key
        ];
        $user = User::where($data)->first();
        if ($user) {
            return $user['mobile'];
        }
    }
    public function test(Request $request)
    {
        return 1;
    }
    public function getCityByState(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;
        $items = City::where('state_id', $id)->get();
        $output = '<option value="" selected disabled>---Select---</option>';
        foreach ($items as $item) {
            $output .= '<option value="' . $item['id'] . '">' . $item['city'] . '</option>';
        }
        return $output;
    }
    public function get_sub_category_question(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;

        $items = SubCategory::where('category_id', $id)->get();
        $output = '';
        if ($id == '3') {
            foreach ($items as $item) {
                $output .=  '<div class="col-md-6 mb-3">

                <label for="subcategory' . $item['id'] . '" role="button"
                class="w-100 d-block rounded-pill d-flex align-items-center justify-content-start gap-2 h-100  categorybox box-shadow-3  text-center">
                <input type="radio" name="subcats[]" class="custom-check subcatinput" onclick="selectSubCategory(event)" value="' . $item['id'] . '" id="subcategory' . $item['id'] . '"/>

                                <h4 class="mb-0">
                                ' . $item['sub_category'] . '
                            </h4>

                </label>

                        </div>
                        ';
            }
        } else {
            foreach ($items as $item) {
                $output .=  '<div class="col-md-6 mb-3">

                <label for="subcategory' . $item['id'] . '" role="button"
                class="w-100 d-block rounded-pill d-flex align-items-center justify-content-start gap-2 h-100  categorybox box-shadow-3  text-center">
                <input type="checkbox" name="subcats[]" class="custom-check subcatinput" onclick="selectSubCategory(event)" value="' . $item['id'] . '" id="subcategory' . $item['id'] . '"/>

                                <h4 class="mb-0">
                                ' . $item['sub_category'] . '
                            </h4>

                </label>

                        </div>
                        ';
            }
            $output .= '<div class="col-md-6 mb-3">

                                        <label for="subcategoryother" id="otherSubCategoryLabel" role="button" class="w-100 rounded-pill d-flex align-items-center justify-content-start gap-2 h-100 categorybox box-shadow-3 text-center">
                                            <input type="checkbox" name="subcats[]" class="custom-check subcatinputOther" onclick="selectSubCategory(event)" value="other" id="subcategoryother">
                                            <h4 class="mb-0">
                                                Other
                                            </h4>
                                        </label>

                                    </div>';
        }

        return $output;
    }
    public function get_end_category_question(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'ids' => 'required',
            'cid' => 'required'
        ]);
        $cid = $request->cid;

        $ids = explode(',', $request->ids);
        $except = ['other'];
        if (!in_array('other', $ids)) {
            $items = EndCategory::where('category_id', $request->cid)->whereIn('sub_category_id', $ids)->get();
            $output = '';
            if ($cid == '3') {
                foreach ($items as $item) {
                    $output .=  '<div class="col-md-6 mb-3">

                   <label for="endcategory' . $item['id'] . '" role="button"
                   class="w-100 d-block rounded-pill d-flex align-items-center justify-content-start gap-2 h-100  categorybox box-shadow-3  text-center">
                   <input type="radio" name="endcats[]" class="custom-check" onclick="selectEndCategory(event,)" value="' . $item['id'] . '" id="endcategory' . $item['id'] . '"/>

                                   <h4 class="mb-0">
                                   ' . $item['end_category'] . '
                               </h4>

                   </label>

                           </div>
                           ';
                }
            } else {
                foreach ($items as $item) {
                    $output .=  '<div class="col-md-6 mb-3">

                   <label for="endcategory' . $item['id'] . '" role="button"
                   class="w-100 d-block rounded-pill d-flex align-items-center justify-content-start gap-2 h-100  categorybox box-shadow-3  text-center">
                   <input type="checkbox" name="endcats[]" class="custom-check" onclick="selectEndCategory(event,)" value="' . $item['id'] . '" id="endcategory' . $item['id'] . '"/>

                                   <h4 class="mb-0">
                                   ' . $item['end_category'] . '
                               </h4>

                   </label>

                           </div>
                           ';
                }
            }
        } else {
            $output = '<input type="text" name="endcats[]" placeholder="Enter custom issue" oninput="selectEndCategory(event)" class="form-control rounded-pill shadow-none" />';
        }

        return $output;
    }
    public function get_packages(Request $request)
    {
        $request->validate([
            'eid' => 'required',
            'id' => 'required'
        ]);
        $id = $request->id;
        $eid = $request->eid;
        $fee = ExpertFee::where('id', $id)->where('is_active', '1')->first();

        $items =  Package::where('duration', $fee['duration'])->orderBy('quantity', 'ASC')->get();
        $output = '<div class="row">';
        foreach ($items as $i => $p) {
            $value = $p['quantity'];
            if ($p['discount'] > 0) {
                $dis = '<span class="discount">
                            Discount ' . $p['discount'] . '%
                        </span>';
            } else {
                $dis = null;
            }
            $fee_box = $fee['fee'] * $p['quantity'] - ($fee['fee'] * $p['discount'] * $p['quantity']) / 100;

            $output .= ' <div class="col-md-6 mb-4">
                                            <label for="quantity' . $i . '"
                                                class="w-100 quantitylabel px-1 py-2   d-block bx-package box-shadow-1">
                                                <input type="radio"
                                                    class="visually-hidden quantityInput position-absolute top-0 start-0" name="quantity"
                                                    id="quantity' . $i . '" data-val="' . $value . '" value="' . $p['id'] . '">
                                                    ' . $dis . '
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="w-100 ">
                                                            <p class="mb-0">
                                                                No of Sessions
                                                            </p>
                                                            <p class="mb-0 fw-bold">
                                                                ' . $p['quantity'] . '
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="w-100 ">
                                                            <p class="mb-0">
                                                                Net Pay
                                                            </p>
                                                            <p>
                                                                ₹
                                                               ' . $fee_box . '
                                                        </div>

                                                    </div>
                                                </div>


                                            </label>
                                        </div>';
        }
        $output .= '</div>';
        return $output;
    }
    public function  get_slot(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'eid' => 'required',

        ]);
        date_default_timezone_set('Asia/kolkata');
        $date = $request->date;
        $now = date('Y-m-d H:i:s');
        $before = date('Y-m-d H:i:s', strtotime($now . '-25 minutes'));

        $eid = $request->eid;
        $dr = $request->duration;
        if ($dr == "00:30:00" || $dr == "01:00:00") {
            $fid = (strtotime($dr) - strtotime(date('Y-m-d'))) / 60;
        } else {
            $fid = $request->duration;
        }

        $data = [
            'expert_id' => $eid,
            'is_paid' => '0'
        ];
        $fee = ExpertFee::where('id', $fid)->first();

        if ($fee) {
            $duration = (strtotime($fee['duration']) - strtotime(date('Y-m-d'))) / 60;
        } else {
            $duration = $fid ?? '60';
        }

        if ($date ==  date('Y-m-d', strtotime($now))) {
            $cH = date('H');
            $ch =  $cH . ':00:00';

            $cgap = SlotTimeGap::where('current_hour', $ch)->first();
            if ($request->searchby) {
                $gap = 0;
            } else {
                $gap = $cgap['hour_gap'];
            }


            $rdate = date('Y-m-d H:i:s', strtotime($now . " + {$gap} hours"));
            $items = Slot::where($data)
                ->whereNotIn('id', function ($q) use ($before) {
                    $q->from('carts')->where('created_at', '>', $before)->select('slot_id');
                });
            $items->whereDate('slot', '=', $date)->where('slot', '>', date('Y-m-d H:i:s', strtotime($rdate)))
                ->where('duration', (string)$duration)->orderBy('slot', 'ASC');
        } else {
            $rdate = $date;

            $items = Slot::where($data)
                ->whereNotIn('id', function ($q) use ($before) {
                    $q->from('carts')->where('created_at', '>', $before)->select('slot_id');
                })
                ->whereDate('slot', date('Y-m-d', strtotime($rdate)))->where('duration', '=', (string)$duration)->orderBy('slot', 'ASC');
        }

        $output = '<div class="row gy-2">';
        foreach ($items->get() as $i => $item) {
            if ($item['is_paid'] == '0') {
                $output .= '
                        <div class="col-md-12">
                                <label  role="button" for="slot' . $i . '" class="slots d-inline-block labelslot d-flex align-items-sm-center rounded-1 gap-2">
                                    <input type="radio" class="labelslotinput" id="slot' . $i . '" name="slot" data-val="' . date('h:i A', strtotime($item['slot'])) . '" value="' . $item['id'] . '">
                                    ' . date('h:i A', strtotime($item['slot'])) . '
                                </label>
                        </div>
                       ';
            }
        }
        $output .= '</div>';
        if ($items->count()) {
            return $output;
        } else {
            return '<div class="alert alert-warning rounded box-shadow-2 "> Sorry ! No Slot Available ' . $duration . ' minutes</div>';
        }
    }
    public function get_slot_count(Request $request)
    {
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'date' => 'required',
            'eid' => 'required'
        ]);
        $date = $request->date;
        $now = date('Y-m-d H:i:s');
        $eid = $request->eid;
        $data = [
            'expert_id' => $eid,
            'is_paid' => '0'

        ];
        if ($date ==  date('Y-m-d', strtotime($now))) {
            $cH = date('H');
            $ch =  $cH . ':00:00';

            $cgap = SlotTimeGap::where('current_hour', $ch)->first();

            $gap = $cgap['hour_gap'];

            $rdate = date('Y-m-d H:i:s', strtotime($now . " + {$gap} hours"));
            $items = Slot::where($data)->whereDate('slot', '=', $date)->where('slot', '>', date('Y-m-d H:i:s', strtotime($rdate)))->orderBy('slot', 'ASC')->get();
        } else {
            $rdate = $date;

            $items = Slot::where($data)->whereDate('slot', date('Y-m-d', strtotime($rdate)))->orderBy('slot', 'ASC')->get();
        }

        #$items = Slot::where($data)->whereDate('slot', date('Y-m-d', strtotime($date)))->where('is_paid', '0')->orderBy('slot', 'ASC')->get();
        echo count($items);
    }
    public function get_events(Request $request)
    {
        $eid = Auth::user()->uid ?? $request->expert_id;
        $items = Slot::where('expert_id', $eid)->get();
        $arr = [];
        foreach ($items as $item) {
            $mitem = [];
            $mitem['title'] = ($item['user_id']) ? ('Client') : ('Open');
            $mitem['start'] = $item['slot'];
            if ($item['slot_end']) {
                $mitem['end'] = $item['slot_end'];
            }
            $mitem['id'] = $item['id'];
            $mitem['backgroundColor'] = ($item['is_paid'] == '1') ? ('F67C33') : ('#077773');
            array_push($arr, $mitem);
        }
        echo json_encode($arr);
    }
    public function send_otp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:4|exists:users,email'
        ]);
        if ($validator->fails()) {
            return response()->json([

                'response' => '0',
                'status' => '500',
                'error' => $validator->errors()
            ]);
        } else {
            $otp = mt_rand(1111, 9999);
            $email = $request->email;
            $data = [
                'otp' => $otp,
                'email' => $request->email
            ];
            if (DB::table('otps')->insert($data)) {
                $mailData = [
                    'subject' => 'Request to Reset Password',
                    'body' =>  'Dear User your otp is ' . $otp,
                ];
                if (Mail::to($email)->send(new CustomMail($mailData))) {
                    return response()->json(['status' => 200, 'success' => '1', 'message' => 'OTP Send to your email.']);
                }
            }
        }
    }
    public function validate_otp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:4|exists:otps,email',
            'otp' => 'required|min:4|exists:otps,otp'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => '0',
                'status' => '500',
                'error' => $validator->errors()
            ]);
        } else {
            $otp =  $request->otp;
            $email = $request->email;
            $data = [
                'otp' => $otp,
                'email' => $email
            ];
            if (DB::table('otps')->where($data)->first()) {
                return response()->json(['status' => 200, 'success' => '1', 'message' => 'OTP Verified.']);
            } else {
                return response()->json(['status' => 500, 'success' => '1', 'error' => json_encode(["otp" => "Invalid OTP"])]);
            }
        }
    }
    public function set_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:4|exists:otps,email',
            'otp' => 'required|min:4|exists:otps,otp',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'response' => '0',
                'status' => '500',
                'error' => $validator->errors()
            ]);
        } else {
            $otp =  $request->otp;
            $email = $request->email;
            $data = [
                'otp' => $otp,
                'email' => $email
            ];
            if (DB::table('otps')->where($data)->first()) {
                $udata = [
                    'password' => Hash::make($request->password),
                    'remember_token' => $request->password
                ];
                if (User::where(['email' => $email])->update($udata)) {
                    $mailData = [
                        'subject' => 'Request to Reset Password',
                        'body' =>  'Dear User your password is ' . $request->password,
                    ];
                    if (Mail::to($email)->send(new CustomMail($mailData))) {
                        return response()->json(['status' => 200, 'success' => '1', 'message' => 'Password reset successfully.']);
                    }
                }
            } else {
                return response()->json(['status' => 500, 'success' => '1', 'error' => json_encode(["otp" => "Invalid OTP"])]);
            }
        }
    }
    public function get_posts(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;

        $items = Post::where('category_id', $id)->get();

        $output = ' <option value="">---Select Role---</option>';

        foreach ($items as $item) {
            $output .= '<option value="' . $item['id'] . '">' . $item['post'] . '</option>';
        }
        $output .= ' <option value="0">Other</option>';
        return $output;
    }
    public function getexpert_by_category(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;

        $items = Expert::where('designation', $id)->where('is_active', '1')->get();

        $output = ' <option value="">---Select Expert---</option>';

        foreach ($items as $item) {
            $output .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
        }

        return $output;
    }
    public function get_client_details(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;
        $slot = Slot::where('id', $id)->first();
        $item = UserSession::where('slot_id', $id)
            ->join('users', 'users.id', '=', 'user_sessions.user_id')
            ->join('find_experts', 'find_experts.cart_id', '=', 'user_sessions.cart_id')
            ->join('cities', 'cities.id', '=', 'users.city_id')
            ->join('states', 'states.id', '=', 'users.state_id')
            ->select(['users.name',  'users.gender', 'states.state', 'cities.city', 'users.pincode', 'users.age', 'find_experts.sub_cats', 'find_experts.end_cats'])
            ->first();
        return response()->json($item);

        // $user = User::where('users.id', $slot['user_id'])
        // ->join('cities', 'cities.id', '=', 'users.city_id')
        // ->join('states', 'states.id', '=', 'users.state_id')
        // ->select(['name', 'email', 'mobile', 'gender', 'states.state', 'cities.city', 'pincode', 'age'])->first();
        // return response()->json($user);
    }
    public function get_payment_details(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $id = $request->id;

        $item = UserSession::where('id', $id)->first();
        $fdata = [
            'user_id' => $item['user_id'],
            'expert_id' => $item['expert_id'],
            'cart_id' => $item['cart_id'],

        ];

        $c_pay = CartPayment::where($fdata)->first();
        // echo json_encode($c_pay);
        // die;
        $total_fee = $c_pay['base_amount'] + $c_pay['conven_fee'] - $c_pay['dis_package'] - $c_pay['dis_promo'];
        $per_session  = $total_fee / $c_pay['quantity'];
        $refundable = $c_pay['base_amount'] / $c_pay['quantity'];
        $output = '<table class="table table-sm table-light">
                        <tbody>
                            <tr>
                                <th>Package Quantity</th>
                                <td>
                                    ' . $c_pay['quantity'] . '
                                </td>
                            </tr>
                            <tr>
                                <th>Base Amount</th>
                                <td>
 ' . $c_pay['base_amount'] . '
                                </td>
                            </tr>
                            <tr>
                                <th>Cordination Fee</th>
                                <td> ' . $c_pay['conven_fee'] . '</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                               <td> ' . $c_pay['dis_package'] . '</td>
                            </tr>
                            <tr>
                                <th>Discount Promo</th>
                               <td> ' . $c_pay['dis_promo'] . '</td>
                            </tr>
                            <tr>
                                <th>Total Paid</th>
                                <td>' . $total_fee . '</td>
                            </tr>
                            <tr>
                                <th>Per Session Fee</th>
                                <td> ' . $per_session . '</td>
                            </tr>

                            <tr>
                                <th>Refundable</th>
                                <td>
                                    ' . $refundable . '
                                </td>
                            </tr>
                        </tbody>
                    </table>';
        echo $output;
    }
    public function get_chats(Request $request){
        $request->validate([
            'to' => 'required|exists:users,id'
        ]);
        $from = auth()->user()->id;
        $to = $request->to;
        $fdata = [
            'from_id' => $from,
            'to_id' => $to,
            'deleted_at' => NULL,
        ];
        $itmes = Chat::where($fdata)->orderBy('id', 'DESC')->paginate(50);
        return response()->json($itmes);
    }
    public function handlegalleryimage(Request $request){
        $id = $request->id;
        $image = Gallery::where('id', $id)->first();
        $isshown = $image->is_shown == "1" ? "0" : "1";
         Gallery::where('id', $id)->update(['is_shown' => $isshown]);
         return true;
    }
}
