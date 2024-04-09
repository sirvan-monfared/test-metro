<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\Commentable;
use App\Traits\Filterable;
use App\Traits\HasFeaturedImage;
use App\Traits\Seoable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Conner\Tagging\Taggable;

class Post extends Model
{
    use HasFactory;
    use Seoable;
    use Filterable;
    use HasFeaturedImage;
    use Commentable;
    use Taggable;

    public $casts = [
        'status' => Status::class,
        'seo' => 'json',
    ];

    protected $images_root = 'images/posts/';

    public function scopePublished($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function viewLink(): string
    {
        return route('front.blog.show', $this);
    }

    public function commentViewLink(): string
    {
        return route('admin.post.comment.index', $this);
    }
}
