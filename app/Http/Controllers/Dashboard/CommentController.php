<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Comment;
use App\Services\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function index()
    {
        $comments = (new CommentService)->getAll();

        return view('dashbord.comment.index', compact('comments'));
    }

    public function show(int $id)
    {
        $comment = Comment::findOrFail($id)
            ->withTrashed(['post' => fn ($q) => $q->select('id')]);

        return view('dashbord.comment.show', compact('comment'));
    }

    public function store(CommentRequest $request): RedirectResponse
    {
        Comment::create($request->validated());

        return redirect()->route('dashboard.comments.index');
    }

    public function approved(Comment $comment): redirectResponse
    {
        $comment->approved = !$comment->approved;
        $comment->save();

        return back()->with('success', 'با موفقیت تغییر یافت');
    }
}
