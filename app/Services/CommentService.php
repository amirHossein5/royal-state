<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Exception\NotFoundException;

class CommentService
{
    public function getAll(): LengthAwarePaginator
    {
        $comments = Comment::with('user:first_name,last_name,id')
            ->latest()
            ->paginate(10);

        return $comments;
    }

    public function findOrFail(int $id): Response|Comment
    {
        $comment = Comment::find($id);

        if (!$comment) {
            throw new NotFoundException('نظر پیدا نشد');
        }

        $comment->load(
            'user:first_name,last_name,id',
            'post:id'
        );

        return $comment;
    }
}
