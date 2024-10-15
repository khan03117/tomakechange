<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Conven_fee;
use App\Models\Policy;
use App\Models\ContactDetail;
use App\Models\Expert;
use App\Models\ExpertFee;
use App\Models\FindExpert;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res['title'] = 'List of Bookings';
       
        $res['items'] = Cart::where('is_confirm', '1')
            ->with('user:id,name,email')->with('package')->with('fee')->with('expert:id,name,email,mobile,languages,modes')
            ->orderBy('id', 'DESC')
            ->get();
        // return response()->json($res['items']);
        // die;
        return view('admin.booking.index', $res);
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
       
        date_default_timezone_set('Asia/kolkata');
        $request->validate([
            'slot' => 'required',
            'duration' => 'required',
            // 'mode' => 'required',
            // 'quantity' => 'required',
            // 'expert_id' => 'required',
            // 'name' => 'required',
            // 'email' => 'required',
            // 'moblie' => 'required'
        ]);
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $fee_id = $request->duration;
        $fee = ExpertFee::where('id', $fee_id)->first();
        $sid = Session::getId();
        $efind = FindExpert::where('session_id', $sid)->orderBy('id', 'DESC')->limit('1')->first();
        $data = [
            'session_id' => (string) $sid,
            'expert_id' => $request->expert_id,
            'package_id' => $request->quantity,
            'expert_fee_id' => $fee_id,
            'mode' => $request->mode,
            'apt_date' => $request->app_date,
            'slot_id' => $request->slot,
            'gender' => $request->gender,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'pincode' => $request->pincode,
            'age' => $request->age,
            'created_at' =>  date('Y-m-d H:i:s')
        ];
        $check = User::where(['email' => $request->email])->first();
        if ($check) {
            $udata = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'designation' => 'User',
                'state_id' => $request->state,
                'city_id' => $request->city,
                'pincode' => $request->pincode,
                'age' => $request->age,
                'gender' => $request->gender,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $uid = $check['id'];
            User::where('id', $uid)->update($udata);
        } else {
            $udata = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make('FeelsGood@123'),
                'remember_token' => 'FeelsGood@123',
                'designation' => 'User',
                'state_id' => $request->state,
                'city_id' => $request->city,
                'pincode' => $request->pincode,
                'age' => $request->age,
                'gender' => $request->gender,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $uid = User::insertGetId($udata);
        }
        $data['user_id'] = $uid;
        $cid = Cart::insertGetId($data);
        if (FindExpert::where('id', $efind['id'])->update(['cart_id' => $cid])) {
            return redirect()->to('checkout');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {

        $sid = Session::getId();
        $res['policies'] = Policy::all();
        $res['socials'] = ContactDetail::where('type', 'social')->get();
        $item = $res['item'] = Cart::where('session_id', $sid)->with('questions')->with('package')->with('expert')->with('fee')->with('slot')->orderBy('id', 'DESC')->first();
        // return response()->json($item);
        // die;
        $res['title'] = 'Checkout';
        if ($item) {
            if ($item['slot']['is_paid'] == '0') {
                $res['user'] = User::where('id', $item['user_id'])->first();
                $fdata = [
                    'mode' => strtolower($item['mode']),
                    'quantity' => $item['package']['quantity'],
                    'duration' => $item['package']['duration']
                ];

                $res['conven_fee'] = Conven_fee::where($fdata)->first();
                // return response()->json($res);
                // die;

                return view('frontend.checkout', $res);
            } else {
                return redirect()->to('find-expert');
            }
        } else {
            return redirect()->to('find-expert');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
    public function usersessions($id)
    {
        $res['title'] = 'List of User Sessions';
        $res['cart'] = Cart::where('id', $id)->first();
        $res['items'] = UserSession::where('cart_id', $id)->with('slot')->get();
        $res['user'] = User::where('id', $res['cart']['user_id'])->first();
        $res['expert'] = Expert::where('id', $res['cart']['expert_id'])->first();
        // echo json_encode($res);
        // die;
        return view('admin.booking.sessions', $res);
    }
}
