<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::withCount('comments')
            ->with('author:id,first_name')
            ->paginate(8);

        return view('app.posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        $post->load(
            'comments',
            'comments.user:id,first_name,last_name',
            'comments.chlidren'
        );

        $latestAdvertises = Advertise::latest()
            ->take(5)
            ->get();

        return view('app.posts.show', compact('post'));
    }
}
