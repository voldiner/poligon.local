<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }
    /**
     * @param  BlogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }
    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //
    }
    /** перед обновлением записи */
    public function updating(BlogPost $blogPost)
    {
        // --- полезные методы ---
        /*
        $test[] = $blogPost->isDirty();  // изменялась ли модель
        $test[] = $blogPost->isDirty('is_published');  // изменялась ли поле
        $test[] = $blogPost->getAttribute('is_published'); // new value
        $test[] = $blogPost->is_published;                      // new value
        $test[] = $blogPost->getOriginal('is_published');  // old value
        dd($test);
        */

        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        // return false;  // запрет сохранения
    }

    protected function setPublishedAt(BlogPost $blogPost)
    {
        if (empty($blogPost->published_at) && $blogPost['is_published']){
            $blogPost->published_at = Carbon::now();
        }
    }

    protected function setSlug(BlogPost $blogPost)
    {
        if (empty($blogPost->slug)){
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }

    /**
     * @param BlogPost $blogPost
     */
    protected function setHtml(BlogPost $blogPost)
    {
        if ($blogPost->isDirty('content_raw')){
            // TODO доделать генерацию markdows d html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id =  auth()->id() ?? BlogPost::UNKNOWN_USER;
    }
    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //dd(__METHOD__, $blogPost);
    }

    /**
     * @param \App\Models\BlogPost
     */
    public function deleting(BlogPost $blogPost)
    {
        // dd(__METHOD__, $blogPost);
        //return false; //запрет удаления
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
