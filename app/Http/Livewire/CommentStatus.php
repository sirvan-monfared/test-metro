<?php

namespace App\Http\Livewire;

use App\Enums\CommentStatus as EnumsCommentStatus;
use App\Events\CommentStatusChanged;
use App\Models\Comment;
use App\Services\UserPointsService;
use Livewire\Component;

class CommentStatus extends Component
{
    public $comment;
    public $status;

    public function mount(Comment $comment) {
        $this->comment = $comment;
        $this->status = $comment->status->value;
    }

    public function updatedStatus() {
        $this->comment->status = EnumsCommentStatus::from($this->status);

        $this->comment->save();

        event(new CommentStatusChanged($this->comment, $this->comment->user));
    }

    public function render()
    {
        return view('livewire.comment-status');
    }
}
