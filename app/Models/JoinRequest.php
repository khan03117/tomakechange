<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    use HasFactory;
    public function post_detail()
    {
        return $this->belongsTo(Post::class, 'post', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'apply_for', 'id');
    }
}
