<?php

namespace App\Http\Controllers;

use App\Models\CartPayment;
use App\Models\Refund;
use App\Models\UserSession;
use Illuminate\Http\Request;

class RefundController extends Controller
{
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
        $request->validate([
            'id' => 'required'
        ]);
        date_default_timezone_set('Asia/kolkata');
        $id = $request->id;

        $item = UserSession::where('id', $id)->first();
        $fdata = [
            'user_id' => $item['user_id'],
            'expert_id' => $item['expert_id'],
            'cart_id' => $item['cart_id'],
            'category_id' => $item['category_id']
        ];
        $c_pay = CartPayment::where($fdata)->first();
        $total_fee = $c_pay['base_amount'] + $c_pay['conven_fee'] - $c_pay['dis_package'] - $c_pay['dis_promo'];
        $per_session  = $total_fee / $c_pay['quantity'];
        $refundable = $c_pay['base_amount'] / $c_pay['quantity'];
        $fdata['user_session_id'] = $id;
        $check = Refund::where($fdata)->first();
        if (!$check) {
            $fdata['amount'] = $refundable;
            $fdata['created_at'] = date('Y-m-d H:i:s');
            $rid = Refund::insertGetId($fdata);
        } else {
            $rid = $check['id'];
        }
        $udata = [
            'is_refunded' => '1',
            'refund_id' => $rid
        ];
        if (UserSession::where('id', $id)->update($udata)) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function show(Refund $refund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function edit(Refund $refund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Refund $refund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Refund $refund)
    {
        //
    }
}
