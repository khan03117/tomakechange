<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindExpert extends Model
{
    use HasFactory;
    public function state_name()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }
    public function city_name()
    {
        return $this->hasOne(City::class, 'id', 'city');
    }
}
