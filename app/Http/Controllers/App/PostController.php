<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = request()->has('category')
            ? Post::whereCategory(request()->category)
            ->withCount('comments')
            ->with('author:id,first_name')
            ->paginate(8)

            : Post::withCount('comments')
            ->with('author:id,first_name')
            ->paginate(8);

        return view('app.posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        $comments = Comment::where('post_id', $post->id)
            ->whereNull('parent_id')
            ->with('user:id,first_name,last_name', 'children')
            ->latest()
            ->paginate(4);

        $latestAdvertises = Advertise::latest()
            ->take(5)
            ->get();

        return view('app.posts.show', compact('post', 'latestAdvertises', 'comments'));
    }
}
