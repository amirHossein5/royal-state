<?php

namespace App\Http\Livewire\Dashboard\Comment;

use App\Models\Comment;
use Livewire\Component;

class ApprovedStatus extends Component
{
    public bool $status;
    public int $commentId;

    protected $listeners = ['commentStatusChanged'];

    public function commentStatusChanged(int $commentId): void
    {
        if ($commentId === $this->commentId) {
            $this->status = !$this->status;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.comment.approved-status');
    }
}
