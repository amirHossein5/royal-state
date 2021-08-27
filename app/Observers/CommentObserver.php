<?php

namespace App\Observers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentObserver
{
    /**
     * Handle the Comment "creating" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        $comment['user_id'] = Auth::user()->id;

        if (Auth::user()->hasRole('admin')) {
            $comment['approved'] = 1;
        }
    }
}
