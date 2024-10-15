<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    public function expert()
    {
        return $this->belongsTo(Expert::class, 'expert_id', 'id');
    }
    public  function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
        ->join('cities', 'cities.id', '=', 'users.city_id')
        ->join('states', 'states.id', '=', 'users.state_id')->select(['users.*', 'states.state', 'cities.city']);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id')->where('is_confirm', '1')->with('questions:id,session_id,category_id,sub_cats,end_cats');
    }
    public function user_session()
    {
        return $this->hasOne(UserSession::class, 'slot_id', 'id');
    }
    public function find_expert(){
         return $this->hasOne(FindExpert::class, 'cart_id', 'cart_id');
    }
}
