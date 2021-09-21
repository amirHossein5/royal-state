<?php

namespace App\Http\Livewire\Dashboard\Comment;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ChangeStatus extends Component
{
    use AuthorizesRequests;

    public Comment $comment;

    public function mount()
    {
        $this->authorize('approved', Comment::class);
    }

    public function changeStatus(): void
    {
        $this->comment->approved = !$this->comment->approved;

        $this->comment->save();

        $this->emit('commentStatusChanged',$this->comment->id);
    }

    public function render()
    {
        return view('livewire.dashboard.comment.change-status');
    }
}
