<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function getAll()
    {
        $comments = Comment::with(['user' => fn ($q) => $q->select('first_name', 'last_name')])
            ->latest()
            ->paginate(10);

        return $comments;
    }
}
