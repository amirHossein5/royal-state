<?php

namespace App\Providers;

use App\Events\CommentCreated;
use App\Listeners\SendEmailCommentCreatedListener;
use App\Models\Advertise;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Observers\AdvertiseObserver;
use App\Observers\CategoryObserver;
use App\Observers\PostObserver;
use App\Observers\CommentObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentCreated::class => [
            SendEmailCommentCreatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
        Advertise::observe(AdvertiseObserver::class);
        User::observe(UserObserver::class);
    }
}
