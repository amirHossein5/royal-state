<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\CommentCreated;
use App\Models\Comment;
use App\Services\CommentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = (new CommentService)->getAll();

        return view('dashbord.comments.index', compact('comments'));
    }

    public function show(int $id)
    {
        $comment = (new CommentService)->findOrFail($id);

        $this->authorize('view', $comment);

        return view('dashbord.comments.show', compact('comment'));
    }

    public function store(CommentRequest $request): RedirectResponse
    {
        $parentComment = (new CommentService)->findOrFail($request->parent_id);

        $this->authorize('reply', $parentComment);

        event(new CommentCreated(
            $parentComment->user_id,
            $request->comment,
            $parentComment->comment
        ));

        return redirect()->route('dashboard.comments.index');
    }
}
