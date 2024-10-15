<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public function endcategory()
    {
        return $this->hasMany(EndCategory::class, 'sub_category_id', 'id');
    }
}
