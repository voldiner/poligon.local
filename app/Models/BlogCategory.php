<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int ROOT
 * @property  BlogCategory $parentCategory
 * @property  string $parentTitle
 *
 */

class BlogCategory extends Model
{
   use SoftDeletes;

   const ROOT = 1;

   protected $fillable = [
     'title',
     'slug',
     'parent_id',
     'description',
   ];
   /**
    * Получить родительскую категорию
    * @return BlogCategory
    */
   public function parentCategory()
   {
       return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
   }

    /**
     * пример аксесуара (Accessor)
     *  @return string
     */
   public function getParentTitleAttribute()
   {
       $title = $this->parentCategory->title ?? ($this->isRoot() ? 'Root' : '???');
       return $title;
   }

   public function isRoot()
   {
       return $this->is === BlogCategory::ROOT;
   }
}
