<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function expert()
    {
        return $this->belongsTo(Expert::class, 'expert_id', 'id');
    }
    public function fee()
    {
        return $this->belongsTo(ExpertFee::class, 'expert_fee_id', 'id');
    }
    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id', 'id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
    public function questions()
    {
        return $this->belongsTo(FindExpert::class, 'session_id', 'session_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function sessions()
    {
        return $this->hasMany(UserSession::class, 'cart_id', 'id');
    }
    public function pending_sessions()
    {
        $fdata = ['status' => 'Pending'];
        return $this->hasMany(UserSession::class, 'cart_id', 'id')->where($fdata)->where('slot_id', '!=', null);
    }
    public function closed_sessions()
    {
        $fdata = ['status' => 'Done'];
        return $this->hasMany(UserSession::class, 'cart_id', 'id')->where($fdata)->where('slot_id', '!=', null);
    }
    public function cancelled_sessions()
    {
        $fdata = ['status' => 'Cancelled'];
        return $this->hasMany(UserSession::class, 'cart_id', 'id')->where($fdata);
    }
    public function empty_slot_sessions(){
         $fdata = ['status' => 'Pending'];
        return $this->hasMany(UserSession::class, 'cart_id', 'id')->where($fdata)->where('slot_id', '=', NULL);
    }
    public function all_pending_slot_sessions(){
         $fdata = ['status' => 'Pending'];
        return $this->hasMany(UserSession::class, 'cart_id', 'id')->where($fdata);
    }
    public function cart_payment(){
       return $this->hasOne(CartPayment::class, 'cart_id', 'id');
    }
    public function packages(){
         return $this->belongsTo(Package::class,  'package_id', 'id');
    }
}
