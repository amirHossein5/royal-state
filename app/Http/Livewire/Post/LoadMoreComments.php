<?php

namespace App\Http\Livewire\Post;

use App\Models\Comment;
use Illuminate\View\View;
use Livewire\Component;

class LoadMoreComments extends Component
{
    public $postId;
    public int $totalComments;
    public int $take = 4;

    public function loadMore(): Void
    {
        $this->take += 4;
    }

    public function setReplyTo(int $id)
    {
        $this->emit('replySetted', $id);
    }

    public function destroy(int $id)
    {
        $comment = Comment::where('id', $id)->first();

        if (auth()->user()->id === $comment->user_id) {
            $comment->delete();
        }

        $this->render();
    }

    public function render(): View
    {
        $query = Comment::where('post_id', $this->postId)
            ->whereNull('parent_id')
            ->where('approved', true);

        $this->totalComments = $query->count();

        $comments = $query->with('user:id,first_name,last_name', 'children')
            ->latest()
            ->take($this->take)
            ->get();

        return view('livewire.post.load-more-comments', compact('comments'));
    }
}
