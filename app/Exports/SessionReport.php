<?php

namespace App\Exports;

use App\Models\Slot;
use App\Models\Cart;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SessionReport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
     public $fdate;
     public $tdate;
     
     function __construct($fdate, $tdate)
    {
        $this->fdate = $fdate;
        $this->tdate = $tdate;
       
    } 
    
    public function collection()
    {
        
        $items = Cart::where('payment_status', 'Success')
        ->with('expert:id,name,email,mobile,profile_image,designation')
        ->with('user:users.id,name,email,mobile,gender')
        ->withCount('all_pending_slot_sessions')
        ->withCount('closed_sessions')
        ->with('cart_payment')
        ->withCount('cancelled_sessions');
        if($this->fdate){
            $f_date = $this->fdate;
            $items->whereDate('created_at', '>=', $f_date);
        }
        if($this->tdate){
            $t_date = $this->tdate;
            $items->whereDate('created_at', '<=', $t_date);
        }
        $sessions = $items->orderBy('created_at', 'DESC')->get();
        return $sessions;
    }
    public function headings(): array
    {
        return [
            'Expert Name',
            'Category',
            'Date',
            'Client Name',
            'Pending  Sessions',
            'Closed  Sessions',
            'Cancelled  Sessions',
            'Base  Fee',
            'Coordinate  Fee',
            'Discount',
            'total_amount',
            'Bank Ref No',
            'Tracking Id',
        ];
    }
    public function map($item): array
    {
        return [
            $item->expert->name,
            $item->expert->designation == '1' ? 'Counselling' : "Coaching",
            $item->created_at,
            $item->user->name,
            $item->all_pending_slot_sessions_count,
            $item->closed_sessions_count,
            $item->cancelled_sessions_count,
            $item->cart_payment->base_amount,
            $item->cart_payment->conven_fee,
            $item->cart_payment->dis_package,
            json_decode($item->cca_response)[0]->amount,
            json_decode($item->cca_response)[0]->bank_ref_no,
            json_decode($item->cca_response)[0]->tracking_id

        ];
    }
}
