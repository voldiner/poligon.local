<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    public function category()
    {
        // статья принадлежит категории
        return $this->belongsTo(BlogCategory::class);
    }

    public function user()
    {
        // статья принадлежит автору
        return $this->belongsTo(User::class);
    }
}
