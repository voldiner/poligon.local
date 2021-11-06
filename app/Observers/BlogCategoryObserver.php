<?php

namespace App\Observers;

use App\Models\BlogCategory;

class BlogCategoryObserver
{
    /**
     * Handle the blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }
    /**
     * Handle the blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }

    /** перед обновлением записи */
    public function updating(BlogCategory $blogCategory)
    {
        // --- полезные методы ---
        /*
        $test[] = $blogCategory->isDirty();  // изменялась ли модель
        $test[] = $blogCategory->isDirty('is_published');  // изменялась ли поле
        $test[] = $blogCategory->getAttribute('is_published'); // new value
        $test[] = $blogCategory->is_published;                      // new value
        $test[] = $blogCategory->getOriginal('is_published');  // old value
        dd($test);
        */
        //dd($blogCategory->getDirty());
        $this->setSlug($blogCategory);
        // return false;  // запрет сохранения
    }

    protected function setSlug(BlogCategory $blogCategory)
    {
        if (empty($blogCategory->slug)){
            $blogCategory->slug = \Str::slug($blogCategory->title);
        }
    }

    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
