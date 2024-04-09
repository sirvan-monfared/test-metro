<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\Commentable;
use App\Traits\Filterable;
use App\Traits\Seoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Podcast extends Model
{
    use HasFactory;
    use Seoable;
    use Commentable;
    use Filterable;
    use Taggable;

    protected $casts = [
        'status' => Status::class,
        'seo' => 'json',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function viewLink()
    {
        return route('front.podcast.show', $this);
    }

    public function commentViewLink(): string
    {
        return route('admin.podcast.comment.index', $this);
    }

    public static function latestEpisode()
    {
        return Podcast::max('episode');
    }

    public static function newEpisode()
    {
        return self::latestEpisode() + 1;
    }
}
