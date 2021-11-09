<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property string $content_raw
 * @property string $content_html
 * @property int $UNKNOWN_USER
 * @property int $user_id
 */
class BlogPost extends Model
{
    use SoftDeletes;
    const UNKNOWN_USER = 1;

    protected $fillable = [
      'title',
      'slug',
      'category_id',
      'exerpt',
      'content_raw',
      'is_published',
      'published_at',
    ];

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
