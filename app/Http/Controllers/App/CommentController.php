<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request, Post $post): RedirectResponse
    {
        $user = !auth()->user()
            ? AuthService::setUser($request->only(['first_name', 'last_name', 'email', 'password']))
            ->loginOrRegister(false)
            ->get()
            : auth()->user();

        if (is_string($user)) {
            return back()
                ->withErrors(['email' => $user])
                ->withInput();
        }

        $post->comments()->create([
            'user_id' => $user->id,
            'comment' => $request->comment,
            !$request->has('replyTo') ?: 'parent_id' => $request->replyTo
        ]);

        return back();
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        if (auth()->user()->id === $comment->user_id) {
            $comment->delete();
        }

        return back();
    }
}
