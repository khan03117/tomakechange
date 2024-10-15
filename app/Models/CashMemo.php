<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashMemo extends Model
{
    use HasFactory;
    protected $fillable = ['area_id','area', 'delivery_boy_id', 'cm_date', 'cm_number', 'consumer_id', 'name', 'address', 'mobile'];
}
