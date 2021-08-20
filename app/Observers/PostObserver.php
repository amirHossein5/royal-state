<?php

namespace App\Observers;

use App\Models\Post;
use GuzzleHttp\Psr7\Request;

class PostObserver
{
    /**
     * Handle the Post "creating" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post['user_id'] = auth()->user()->id;
    }
}
