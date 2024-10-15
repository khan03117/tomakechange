<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    public function cashmemo(){
        return $this->hasMany(CashMemo::class, 'area_id', 'id');
    }
}
