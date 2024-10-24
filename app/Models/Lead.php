<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    public function search_data()
    {
        return $this->hasOne(FindExpert::class, 'id', 'search_id')->with('city_name')->with('state_name');
    }
    public function is_assigned()
    {
        return $this->hasOne(ExpertPoint::class, 'lead_id', 'id')->where('expert_id', auth()->user()->uid);
    }
    public function assigns()
    {
        return $this->hasMany(ExpertPoint::class, 'lead_id', 'id');
    }
    public function assigns_confirm()
    {
        return $this->hasMany(ExpertPoint::class, 'lead_id', 'id')->where('is_confirm', '1');
    }
}