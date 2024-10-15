<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartPayment extends Model
{
    use HasFactory;
    public function expert()
    {
        return $this->hasOne(Expert::class, 'id', 'expert_id');
    }
}
