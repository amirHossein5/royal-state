<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::withCategory()
            ->withAuthor()
            ->withTrashed()
            ->latest()->paginate(5);

        return view('dashbord.post.index', compact('posts'));
    }

    public function create(): View
    {
        $this->authorize('create',Post::class);

        $categories = (new CategoryService)->getAll();

        return view('dashbord.post.create', compact('categories'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $this->authorize('create', Post::class);

        (new PostService)
            ->store($request->validated());

        return redirect()
            ->route('dashboard.posts.index')->with('success', 'با موفقیت ساخنه شد');
    }

    public function edit(Post $post): View
    {
        $this->authorize('update', Post::class);

        $categories = (new CategoryService)->getAll();

        $post = (object) $post->toArray();

        return view('dashbord.post.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', Post::class);

        (new PostService)
            ->update($request->validated(), $post);

        return redirect()
            ->route('dashboard.posts.index')
            ->with('success', 'با موفقیت بروزرسانی شد');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', Post::class);

        $post->delete();

        return back()
            ->with('success', 'با موفقیت پاک شد.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $this->authorize('forceDelete', Post::class);

        Post::withTrashed()
            ->where('id', $id)
            ->forceDelete();

        return back()
            ->with('success', 'با موفقیت پاک شد.');
    }

    public function restore(int $id): RedirectResponse
    {
        $this->authorize('restore', Post::class);

        Post::withTrashed()
            ->where('id', $id)
            ->restore();

        return back()
            ->with('success', 'با موفقیت باز گردانده شد.');
    }
}
