<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\Course;

trait Commentable
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function publishedReviews($limit = false)
    {
        return $this->comments()->published()->isParent()->with([
            'user',
        ])->latest()->take($limit)->get();
    }

    public function publishedCommentsWithChildren()
    {
        return $this->comments()->published()->isParent()->with([
            'user',
            'children.user',
            'children.children.user',
        ])->get();
    }

    public function allCommentsWithChildren()
    {
        return $this->comments()->isParent()->with([
            'user',
            'allChildren.user',
            'allChildren.allChildren.user',
        ])->get();
    }

    public function publishedCommentsCount()
    {
        return cache()->remember(
            $this->getPublishedCommentsCountCacheKeyName(),
            86400,
            fn () => $this->comments()->published()->count()
        );
    }

    public function averageRatings()
    {
        return cache()->remember(
            $this->getAverageRatingCacheKeyName(),
            86400,
            fn () => $this->comments()->published()->average('rating')
        );
    }

    public function isUserAlreadyCommented($user_id = null)
    {
        if (!$user_id && !auth()->check()) {
            return false;
        }

        $user_id = $user_id ?: auth()->id();

        return $this->comments()->where('user_id', $user_id)->first();
    }

    public function randomReview()
    {
        return $this->comments(function ($query) {
            return $query->where('rating', 5);
        })->with('user')->published()->inRandomOrder()->first();
    }

    public function reviewsInfo(): array
    {
        $output = [];

        for ($i = 1; $i <= 5; $i++) {
            $output["stars_{$i}"] = $this->countByStars($i);
        }
        
        return $output;
    }

    public function countByStars($stars)
    {
        return $this->comments()->where('rating', $stars)->count();
    }

    protected function getAverageRatingCacheKeyName()
    {
        $model = class_basename(get_called_class());
        return "avg_rating_{$model}_{$this->id}";
    }

    protected function getPublishedCommentsCountCacheKeyName()
    {
        $model = class_basename(get_called_class());
        return "pbs_count_{$model}_{$this->id}";
    }
}
