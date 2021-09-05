<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Post;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request, Post $post): RedirectResponse
    {
        $user = AuthService::setUser($request->only(['first_name', 'last_name', 'email', 'password']))
            ->loginOrRegister(false)
            ->get();

        $post->comments()->create([
            'user_id' => $user->id,
            'comment' => $request->comment
        ]);

        return redirect()
            ->back();
    }
}
