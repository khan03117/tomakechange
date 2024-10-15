<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')->with('endcategory');
    }
    public function sessions()
    {
        return $this->hasMany(UserSession::class, 'category_id', 'id');
    }
    public function completed_sessions()
    {
        return $this->hasMany(UserSession::class, 'category_id', 'id')->where('status', 'Done');
    }
    public function cancelled_sessions()
    {
        return $this->hasMany(UserSession::class, 'category_id', 'id')->where('status', 'Cancelled');
    }
    public function fee_collection()
    {
        return $this->hasMany(CartPayment::class, 'category_id', 'id')->where('cca_status', 'Success');
    }
}