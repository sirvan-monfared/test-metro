<?php

namespace App\Http\Livewire;

use App\Services\CommentService;
use Livewire\Component;

class CommentItem extends Component
{
    public $comment;
    public $showChildren = false;
    public $showReply = false;
    public $replying = false;
    public $bgClass = 'bg-light-info';
    public $reply;

    public function render()
    {
        return view('livewire.comment-item');
    }

    public function createReply()
    {
        $this->validate([
            'reply' => ['required', 'min:3'],
        ]);

        CommentService::storeAsAdmin($this->comment->commentable, [
            'parent_id' => $this->comment->id,
            'body' => $this->reply,
        ]);

        $this->reply = null;
        $this->replying = false;

        session()->flash('success', 'دیدگاه با موفقیت ارسال شد');
    }
}
