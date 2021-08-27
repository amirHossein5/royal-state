<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('comment_view_any');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Comment $comment)
    {
        return $this->view_all($user) ||
            ($user->hasPermission('comment_view') &&
                $comment->load('post.author')->user->id === $user->id);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reply(User $user, Comment $comment)
    {
        return $user->hasPermission('comment_reply') &&
            $comment->user_id !== $user->id;
    }

    /**
     * Determine whether the user can view all the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view_all(User $user)
    {
        return $user->hasPermission('comment_view_all');
    }

    /**
     * Determine whether the user can approved the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function approved(User $user)
    {
        return $user->hasPermission('comment_approved');
    }
}
