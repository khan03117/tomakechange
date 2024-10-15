<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Slot;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class ExpertSessions implements FromCollection, WithMapping, WithHeadings
{
    protected $time;
    protected $url;
    protected $month;

    function __construct($url, $time, $month)
    {
        $this->time = $time;
        $this->url = $url;
        $this->month = $month;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $items  = Slot::where('is_paid', '1')->where('slots.expert_id', Auth::user()->uid)->with('expert:id,name,email,mobile')
            ->with('user')
            ->with('find_expert')
            ->join('user_sessions', 'user_sessions.slot_id', '=', 'slots.id')
            ->join('carts', 'carts.id', '=', 'slots.cart_id')
            ->join('cart_payments', 'cart_payments.cart_id', '=', 'slots.cart_id', 'left')
            ->join('find_experts', 'find_experts.session_id', '=', 'carts.session_id')
            ->join('categories', 'categories.id', '=', 'find_experts.category_id')
            ->where('cart_payments.cca_status', 'Success');
        if ($this->url != 'all') {
            $items->where('slots.booking_status', $this->url);
        }
        if ($this->time == 'today') {
            $items->whereDate('slot', '=', date('Y-m-d'));
        }
        if ($this->time == 'upcoming') {
            $items->whereDate('slot', '>', date('Y-m-d'));
        }
        if ($this->time == 'outdated') {
            $items->whereDate('slot', '<', date('Y-m-d'));
        }
         if($this->month){
            $items->whereMonth('slot', '=', date('m', strtotime($this->month)));
        }
        if($this->month){
            $items->whereYear('slot', '=', date('Y', strtotime($this->month)));
        }
        $slots =  $items->select(['slots.*', 'categories.category', 'find_experts.sub_cats', 'find_experts.end_cats', 'user_sessions.id as usid', 'user_sessions.status as meeting_status', 'cart_payments.base_amount'])->orderBy('slot', 'DESC')->get();

        // echo json_encode($slots);
        // die;
        return $slots;
    }
    public function headings(): array
    {
        return [
            'Client Name',
            'Topic',
            'Start Time',
            'End Time',
            'Duration',
            'amount',
            'Status'
        ];
    }
    public function map($slot): array
    {
        return [
            $slot['user']['name'],
            $slot['category'],
            date('d-M-Y h:i A', strtotime($slot['slot'])),
            date('d-M-Y h:i A', strtotime($slot['slot_end'])),
            $slot['duration'],
            $slot['base_amount'],
            $slot['booking_status']

        ];
    }
}
