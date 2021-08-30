<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Models\User;
use App\Notifications\CommentCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendEmailCommentCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        Notification::send(
            User::find($event->user_id),
            new CommentCreatedNotification($event->comment, $event->parentComment)
        );
    }
}
