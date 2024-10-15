<?php

namespace App\Exports;

use App\Models\Slot;
use App\Models\Cart;
use App\Models\UserSession;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserSessions implements FromCollection, WithMapping, WithHeadings
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
        
        $items = UserSession::where('status', '=', 'Done')->with('user:users.id,name,email,mobile,gender')
        ->with('expert:id,name,email,mobile,profile_image,designation')
        ->with('slot:id,slot,slot_end,is_paid,booking_status,order_id')
        ->with('cart:carts.id,carts.cca_response,payment_status,booking_status,for_me,base_amount,conven_fee,sub_cats,end_cats,package_id')
        ->orderBy('user_sessions.apt_date','DESC');
       
        if($this->fdate){
            $f_date = $this->fdate;
         $items->where('apt_date', '>=', $f_date);
        }
        if($this->tdate){
            $t_date = $this->tdate;
           $items->where('apt_date', '<=', $t_date);
        }
       $sessions = $items->get();
        return $sessions;
    }
    public function headings(): array
    {
        return [
            'Expert Name',
            'Category',
            'Date',
            'Mode',
            'Duration',
            'Client Name',
            
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
            $item->apt_date,
            $item->mode,
            (strtotime($item->slot->slot_end) - strtotime($item->slot->slot) )/60,
            $item->user->name,
            
            $item->cart->base_amount/$item->cart->packages->quantity,
            $item->cart->conven_fee/$item->cart->packages->quantity,
            $item->cart->dis_package/$item->cart->packages->quantity,
            json_decode($item->cart->cca_response)[0]->amount/$item->cart->packages->quantity,
            "'".json_decode($item->cart->cca_response)[0]->bank_ref_no,
            "'".json_decode($item->cart->cca_response)[0]->tracking_id

        ];
    }
}
