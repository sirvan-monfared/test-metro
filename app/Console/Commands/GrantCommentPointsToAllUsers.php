<?php

namespace App\Console\Commands;

use App\Enums\CommentStatus;
use App\Enums\CommentType;
use App\Events\CommentStatusChanged;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Console\Command;

class GrantCommentPointsToAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'point:comment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command grant points to all users who has approved review on courses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $comments = Comment::with('user')
            ->where('type', CommentType::REVIEW)
            ->where('status', CommentStatus::ACTIVE)
            ->where('commentable_type', Course::class)
            ->get();

        $this->withProgressBar($comments, function(Comment $comment) {
            event(new CommentStatusChanged($comment, $comment->user));
        });
    }
}
