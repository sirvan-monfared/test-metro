<?php

namespace App\Services;

use App\Enums\CommentStatus;
use App\Enums\CommentType;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentService
{
    public static function store(CommentType $type, $commentable, Request $request): void
    {
        $commentable->comments()->create([
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
            'body' => $request->body,
            'rating' => ($type->hasRating() && $request->rating) ? (int) $request->rating : null,
            'type' => $type->value
        ]);
    }

    public static function storeAsAdmin($commentable, $data): void
    {
        $commentable->comments()->create([
            'user_id' => auth()->id(),
            'parent_id' => data_get($data, 'parent_id'),
            'body' => data_get($data, 'body'),
            'status' => CommentStatus::ACTIVE
        ]);
    }

    public static function totalBetween($from, $to): int
    {
        return Comment::query()
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->count('id');
    }
}
