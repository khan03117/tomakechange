<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;
    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id', 'id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id')
        ->join('find_experts', 'find_experts.cart_id', '=', 'carts.id')
        ->join('cart_payments', 'cart_payments.cart_id', '=', 'carts.id')
        ->select([
            'carts.*', 
            'find_experts.for_me',
            'find_experts.category_id',
            'find_experts.sub_cats', 
            'find_experts.end_cats',
            'cart_payments.quantity',
            'base_amount',
            'conven_fee',
            'dis_package',
            'dis_promo'
           
        ])->with('packages');
    }
    public function expert(){
         return $this->belongsTo(Expert::class, 'expert_id', 'id');
    }
    public function user(){
         return $this->belongsTo(User::class, 'user_id', 'id')
         ->join('states', 'states.id', '=', 'users.state_id')
         ->join('cities', 'cities.id', '=', 'users.city_id')
         ->select(['users.*', 'states.state', 'cities.city']);
         
    }
}
