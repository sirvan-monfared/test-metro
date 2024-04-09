<?php

namespace App\Models;

use App\Enums\CommentStatus;
use App\Enums\CommentType;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use Filterable;

    protected $casts = [
        'status' => CommentStatus::class,
    ];

    public function commentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->published()->latest();
    }

    public function allChildren(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function scopeIsParent($builder)
    {
        return $builder->whereNull('parent_id');
    }

    public function scopePublished($builder)
    {
        return $builder->where('status', CommentStatus::ACTIVE);
    }

    public function commentableTypeName(): string
    {
        if ($this->commentable instanceof Course) {
            return 'دوره';
        }
        if ($this->commentable instanceof Post) {
            return 'پست';
        }
        if ($this->commentable instanceof Podcast) {
            return 'پادکست';
        }

        return '';
    }

    public function isReview(): bool
    {
        return $this->type === CommentType::REVIEW->value;
    }

    public function commentableFullName(): string
    {
        return $this->commentableTypeName() . " " . $this->commentable->title;
    }

    public function isPublished(): bool
    {
        return $this->status === CommentStatus::ACTIVE;
    }
}
