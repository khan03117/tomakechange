<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirm;
use App\Mail\CustomMail;
use App\Models\Policy;
use App\Models\ContactDetail;
use App\Models\Cart;
use App\Models\CartPayment;
use App\Models\Conven_fee;
use App\Models\Expert;
use App\Models\FindExpert;
use App\Models\Slot;
use App\Models\ExpertSubCategory;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\AllTraits\MyTrait;

class CcaController extends Controller
{
    use MyTrait;
    public function make_payment(Request $request)
    {
        $request->validate([
            'sid' => 'required'
        ]);
        $order_id = time();
        $sid = $request->sid;
        $cart =  $item  = Cart::where('session_id', $sid)->with('package')->with('expert')->with('fee')->orderBy('id', 'DESC')->first();
        Cart::where('id', $item['id'])->update(['order_id' => $order_id]);
        $find = FindExpert::where('session_id', $sid)->orderBy('id', 'DESC')->limit('1')->first();
        $qty = $item['package']['quantity'];
        $d = $item['package']['discount'];
        $fee = $item['fee']['fee'];
        $total = $fee * $qty;
        $dis = $total * $d * 0.01;
        $f_data = [
            'mode' => strtolower($item['mode']),
            'quantity' => $item['package']['quantity'],
            'duration' => $item['package']['duration']
        ];
        $conven_fee = Conven_fee::where($f_data)->first();
        $conven_fee_amount = $total * $conven_fee['rate'] * 0.01 + $conven_fee['fixed_fee'] * $qty;
        $amount = $total + $conven_fee_amount - $dis;
        $c_data = [
            'cart_id' => $cart['id'],
            'user_id' => $cart['user_id'],
            'expert_id' => $cart['expert_id'],
            'category_id' => $find['category_id'],
            'base_amount' => $total,
            'quantity' => $qty,
            'conven_fee' => $conven_fee_amount,
            'dis_package' => $dis,
            'dis_promo' => 0,
            'total_pay' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $check = CartPayment::where([ 'cart_id' => $cart['id'],
            'user_id' => $cart['user_id'],
            'expert_id' => $cart['expert_id'],
            'category_id' => $find['category_id'],
            'base_amount' => $total,
            'quantity' => $qty])->first();
        if(!$check){
            CartPayment::insert($c_data);
        }
        
        // return redirect()->to('payment-response');
        // die;



        $mid = env('CCA_MID');
        $working_key = env('CCA_KEY'); //Shared by CCAVENUES
        $access_code = env('CCA_AC'); //Shared by CCAVENUES
        $custom_order_id = time();
        $fdata = [
            'merchant_id' => $mid,
            'order_id' => $order_id,
            'currency' => "INR",
            'amount' => $amount,
            'redirect_url' => url('response_payment_handler'),
            'cancel_url' => url('cancel_url'),
            'language' => "EN"
        ];
        $i = 0;
        $merchant_data = "";
        foreach ($fdata as $key => $value) {
            if ($i != 6) {
                $merchant_data .= $key . '=' . $value . '&';
            } else {
                $merchant_data .= $key . '=' . $value;
            }
        }
        $encrypted_data = $this->encrypt($merchant_data, $working_key);
        $user = User::where('users.id', $cart['user_id'])
        ->join('states', 'states.id', '=', 'users.state_id')
        ->join('cities', 'cities.id', '=', 'users.city_id')
        ->select(['users.*', 'states.state', 'cities.city'])
        ->first() ;
        $find = $find;
        return view('frontend.ccav', compact('encrypted_data', 'access_code', 'user', 'find'));
    }

    function ccAvenueResponse()
    {
        $workingKey = env('CCA_KEY');    //Working Key should be provided here.
        $encResponse = $_POST['encResp'];                    //This is the response sent by the CCAvenue Server

        $result = $this->decrypt($encResponse, $workingKey);    //Crypto Decryption used as per the specified working key.
        $data = [];
        $status = '';
        $information = explode('&', $result);
        $dataSize = sizeof($information);
        $inner_data = [];



        for ($i = 0; $i < $dataSize; $i++) {
            $info_value = explode('=', $information[$i]);
            $inner_data[$info_value[0]] = $info_value[1];
        }
        array_push($data, $inner_data);
        #echo json_encode($data);
        $oid =  $data[0]['order_id'];
        $status = $data[0]['order_status'];
        Cart::where('order_id', $data[0]['order_id'])->update(['cca_response' => json_encode($data), 'payment_status' => $status]);
       
        $url = 'payment-response/'.base64_encode($oid);
        return redirect()->to($url);
    }

    function encrypt($plainText, $key)
    {
        $key = hex2bin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);
        return $encryptedText;
    }

    function decrypt($encryptedText, $key)
    {
        $key = hex2bin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = hex2bin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }
    public function payment_response($oid)
    {
        // echo base64_encode(1701424822);
        // die;
        
        $oid = base64_decode($oid);
        #$sid = Session::getId();
        $cart = Cart::where('order_id', $oid)->with('package')->with('expert')->with('fee')->orderBy('id', 'DESC')->first();
        $amount = json_decode($cart['cca_response'])[0]->amount;
        if ($cart['is_confirm'] == 0 && $cart['payment_status'] == 'Success') {
            $find = FindExpert::where('cart_id', $cart['id'])->first();
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
                "title": "Edha Expert Meeting",
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
            Cart::where('id', $cart['id'])->update(['is_confirm' => '1']);
            $duration = abs(strtotime(date('Y-m-d')) - strtotime($cart['fee']['duration'])) / 60;
            $data = [
                'slot_end' =>  date('Y-m-d H:i:s', strtotime($duration . " minutes", strtotime($cart['slot']['slot']))),
                'user_id' => $cart['user_id'],
                'is_paid' => '1',
                'updated_at' => date('Y-m-d H:i:s'),
                'meet_id' => (string) $meet_id,
                'meet_response' => $meet_resonse,
                'cart_id' => $cart['id'],
                'order_id' => $oid
            ];
            Slot::where('id', $cart['slot_id'])->update($data);
            $q = $cart['package']['quantity'];
            for ($a = 0; $a < $q; $a++) {
                $edata = [
                    'user_id' => $cart['user_id'],
                    'category_id' => $find['category_id'],
                    'expert_id' => $cart['expert_id'],
                    'mode' => $cart['mode'],
                    'slot_id' => ($a == 0) ? ($cart['slot_id']) : (null),
                    'cart_id' => $cart['id'],
                    'apt_date' => ($a == 0) ? ($cart['apt_date']) : (null),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                UserSession::insert($edata);
            }
            
            $user = User::where('users.id', $cart['user_id'])
            ->join('cities', 'cities.id', '=', 'users.city_id', 'left')
            ->join('states', 'states.id', '=', 'users.state_id', 'left')
            ->select(['users.*', 'cities.city', 'states.state'])
            ->first();
            $this->send_payment_sms('91'.$user['mobile'], $user['name'], $amount);
            
            $expert = Expert::where('id', $cart['expert_id'])->select(['id', 'name', 'email', 'mobile'])->first();
            $slot = Slot::where('id', $cart['slot_id'])->first();
            CartPayment::where([ 'cart_id' => $cart['id'],
            'user_id' => $cart['user_id'],
            'expert_id' => $cart['expert_id'],
            'category_id' => $find['category_id']])->update(['total_pay' => $amount, 'cca_status' => 'Success']);
            
            
          
            
            
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
            $mailDatau = [
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
                'is_new' => 'booked'
                
            ];
           
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
            
            $subject = $q == '1' ? 'A new Session Booking Received' : 'New Package Booking Received';
            $mailData = [
                'subject' => $subject,
                'body' => "Session Booking with {$expert['name']} and {$user['name']} ON {$slot['slot']} To  {$slot['slot_end']} "
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
           
            Mail::to($email)->send(new BookingConfirm($mailDatau));
            Mail::to(env('BOOKING_RECEIVED'))->send(new CustomMail($mailData));
            Mail::to($expert['email'])->send(new CustomMail($mailData1));
            
            //mobile sms
            
            
             if($find['category_id'] == '1'){
                   $type = 'Counselling';
              }
              if($find['category_id'] == '2'){
                   $type = 'Coaching';
              }
              if($find['category_id'] == '3'){
                   $type = 'Self Help';
              }
              $sdate = date('d-M-Y', strtotime($slot['slot']));
              $stime = date('h:i A', strtotime($slot['slot']));
             $msg = "Hi, your {$type} session with {$user['name']} is booked. Date : {$sdate} Time : {$stime} Link to join session : https://edha.life/login Team edha";
             #$msg2 = "{$type} : {$expert['name']} booked with {$user['name']} for Date : {$sdate} Time : {$stime} - Team edha";
             $msg2 = "Hi, your {$type} session with {$user['name']} is booked. Date : {$sdate} Time : $stime} Link to join session : https://edha.life/login Team edha";
             $this->send_sms('91'.$expert['mobile'], $msg2);
             
             
              #$message = "Hi, your {$type} session with {$expert['name']} is confirmed. Date : {$sdate} Time : {$stime} Link to join session : https://edha.life/login Team edha";
              $message = "Hi, your {$type} session with {$expert['name']} is confirmed. Date : {$sdate} Time : {$stime} Link to join session : https://edha.life/login Team edha";
              $this->send_sms('91'.$user['mobile'], $message);
              $mes = "Hi, we have received payment of {$amount} from {$user['name']} toward booking of session. - Team edha";
              $this->send_sms('918920880011', $mes);
              $this->send_sms('918920880011', $msg2);
        }
       
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $res['slot'] = Slot::where('id', $cart['id'])->first();
        $res['cart'] = $cart;
        
          //Auth::login(['email' => $user['email'], 'name' => $user['name']]);
        // return response()->json($res);
        // die;
        Session::regenerate();
        return view('frontend.payment_response', $res);
    }
}
