<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expert;
use App\Models\ExpertFee;
use App\Models\Package;
use App\Models\CartPayment;
use App\Models\UserSession;
use App\Models\Slot;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($url = null, $time = null)
    {
        date_default_timezone_set('Asia/kolkata');
        $res['title'] = 'List of Slot Bookings';
        $res['uname'] = $uname = $_GET['user'] ?? null;
        $res['ename'] = $ename = $_GET['expert'] ?? null;
        $res['ucolumn'] = $ucolumn = $_GET['ucolumn'] ?? null;
        $res['ecolumn'] = $ecolumn = $_GET['ecolumn'] ?? null;
        $res['fdate'] = $fdate = $_GET['fdate'] ?? null;
        $res['tdate'] = $tdate = $_GET['tdate'] ?? null;
        $res['status'] = $status = $_GET['status'] ?? null;
        $res['cat_id'] = $cat_id = $_GET['category_id'] ?? null;
        $items  = Slot::where('is_paid', '1')->with('expert:experts.id,name,email,mobile')
            ->with('user:users.id,name,email,mobile')
            ->join('user_sessions', 'user_sessions.slot_id', '=', 'slots.id')
            ->join('categories', 'categories.id', '=', 'user_sessions.category_id');
        if ($cat_id) {
            $items->where('user_sessions.category_id', $cat_id);
        }
     
     

        if ($uname) {
            $items->whereIn('slots.user_id', function ($query) use ($uname, $ucolumn) {
                $query->select('users.id')->from('users')->where('designation', 'User')->where($ucolumn, "LIKE", "%{$uname}%");
            });
        }
        if ($ename) {
            $items->whereIn('slots.expert_id', function ($query) use ($ename, $ecolumn) {
                $query->select('experts.id')->from('experts')->where($ecolumn, "LIKE", "%{$ename}%");
            });
        }
        if ($status) {
            $items->where('user_sessions.booking_status', $status);
        }
        if ($url != 'all') {
            $items->where('slots.booking_status', $url);
        }
        if ($fdate) {
            $items->whereDate('slot', '>=', $fdate);
        }
        if ($tdate) {
            $items->whereDate('slot', '<=', $tdate);
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
       

        $res['items'] = $items->select([
            'slots.*', 'categories.category',
            'user_sessions.id as usid',
            'user_sessions.is_refundable',
            'user_sessions.is_refunded',
            'user_sessions.refund_id',
           
        ])->orderBy('slots.slot', 'DESC')->paginate(20)->withQueryString();
        $res['categories'] = Category::all();
        $res['url'] = $url;
        $res['time'] = $time;
      
        return view('admin.booking.slot', $res);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($url)
    {
        $res['expert'] = $exp = Expert::where('url', $url)->with('expertize')->with('fee')->with('state')->with('city')->first();
        $res['f_fee'] = $fee = ExpertFee::where('expert_id', $exp['id'])->where('is_active', '1')->first();
        $res['slots'] = Slot::where('expert_id', $exp['id'])->whereDate('slot', date('Y-m-d', strtotime('+1 Days')))
            ->where('is_paid', '0')
            ->whereTime('slot', '>', date('H:i:s'))
            ->get();
        // echo json_encode($res);
        // die;
        $res['items'] = Package::where('duration', $fee['duration'])->orderBy('quantity', 'ASC')->get();
        // echo json_encode($res);
        // die;
        return view('frontend.book-now', $res);
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
            'slot_date' => 'required',
            'slot_time' => 'required',
            'end_time' => 'required'
        ]);
        $slot = date('Y-m-d', strtotime($request->slot_date)).' '.date('H:i:s', strtotime($request->slot_time));
        $etime = $request->end_time;
        $slotdtime = date('Y-m-d H:i:s', strtotime($slot));
        $endtime = date('Y-m-d H:i:s', strtotime($etime . ' minutes', strtotime($slotdtime)));
        $eid = Auth::user()->uid ?? $request->expert_id;
        $data = [
            'expert_id' => $eid,
            'slot' => $slotdtime,
            'slot_end' => $endtime,
            'duration' => $etime
        ];
        // echo json_encode($data);
        // die;
        $check = Slot::where($data)->first();
        if (!$check) {
            $start_time =  date('Y-m-d H:i:s', strtotime($slotdtime));
           $end_time = date('Y-m-d H:i:s', strtotime($endtime));
            
            $same_start = Slot::where('slot', '=',  date('Y-m-d H:i:s', strtotime($slotdtime)))
                ->where(['expert_id' => $eid])->orderBy('id', 'DESC')->first();
                
            $after_end =   Slot::where('slot',  $start_time)
                ->where('slot_end', '>', $end_time)
                ->where(['expert_id' => $eid])->orderBy('id', 'DESC')->first(); 
           
            $before_end =   Slot::where('slot', '=',  $start_time)
            ->where('slot_end', '<', $end_time)
                ->where(['expert_id' => $eid])->orderBy('id', 'DESC')->first(); 
            

            if (!$same_start && !$after_end && !$before_end) {
                if (Slot::insert($data)) {
                    return true;
                } else {
                    return 2;
                }
            } else {
              
                return 2;
            }
        } else {
            return 2;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $res['item'] = UserSession::where('id', $id)
        ->with('slot')
        ->with('cart')
        ->with('expert')
        ->with('user')
        ->first();
        $res['items']  = UserSession::where('cart_id', $res['item']['cart_id'])->with('slot')->get();
        $res['cart_payment'] = CartPayment::where('cart_id', $res['item']['cart_id'])->where('cca_status', 'Success')->first();
        $res['refunds'] = Refund::where('user_id',$res['item']['user_id'])->select('remark')->first();
        // echo json_encode($res['items']);
        // die;
        // return response()->json($res['item']);
        // die;
        return view('admin/booking/show', $res);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function edit(Slot $slot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slot $slot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:slots,id'
        ]);
        $id = $request->event_id;
        if (Slot::where('id', $id)->delete()) {
            return true;
        }
    }
}