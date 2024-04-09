<?php

namespace App\Models;

use App\Enums\CourseLevel;
use App\Enums\CourseRecordStatus;
use App\Enums\DiscountType;
use App\Enums\Status;
use App\Kodesign\SchemaGenerator;
use App\Traits\Commentable;
use App\Traits\HasFeaturedImage;
use App\Traits\Seoable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    use Seoable;
    use HasFeaturedImage;
    use Commentable;

    public $appends = ['get_featured_image', 'get_view_link', 'get_show_price'];

    protected $casts = [
        'level' => CourseLevel::class,
        'discount_type' => DiscountType::class,
        'status' => Status::class,
        'record_status' => CourseRecordStatus::class,
        'seo' => 'json',
    ];

    protected $images_root = 'images/';

    public function scopePublished($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function scopeList($query)
    {
        return $query->published()->latest()->select(['id', 'title', 'slug', 'price', 'duration', 'featured_image', 'level', 'discount_type', 'discount_amount', 'record_status']);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order', 'ASC')->orderBy('id', 'ASC');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot(['status', 'order_id'])
            ->as('enrollment')
            ->using(Enrollment::class)
            ->withTimestamps();
    }

    public function faqs()
    {
        return $this->morphMany(FAQ::class, 'faqable');
    }

    public function viewLink()
    {
        return route('course.show', $this);
    }

    public function activeStudents(): BelongsToMany
    {
        return $this->students()->wherePivot('status', Status::ACTIVE);
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->title;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->finalPrice();
    }

    public function getBuyableWeight($options = null)
    {
        return 1;
    }

    public function finalPrice()
    {

        return intval($this->discount_type->calculate($this->price, $this->discount_amount));
    }

    public function hasDiscount(): bool
    {
        return $this->discount_type != DiscountType::NO_DISCOUNT;
    }

    public function showPrice($bigFontSize = false): string
    {
        return showPrice($this, $bigFontSize);
    }

    public function isInCart(): bool
    {
        return cart()->hasItem($this->id);
    }

    protected function getViewLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->viewLink(),
        );
    }

    protected function getFeaturedImage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->featuredImage()
        );
    }

    protected function getShowPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->showPrice()
        );
    }

    public function ownedByCurrentUser()
    {
        if (!auth()->check()) {
            return false;
        }

        return auth()->user()->alreadyEnrolledIn($this);
    }

    public function isFree()
    {
        return $this->finalPrice() === 0;
    }

    public function hasPreviewVideo()
    {
        return (bool)$this->preview_video;
    }

    public function hasAparatVideo()
    {
        return str_contains($this->preview_video, 'aparat.com');
    }

    public function commentViewLink(): string
    {
        return route('admin.course.comment.index', $this);
    }

    public function withLessons()
    {
        return cache()->remember($this->getCacheKeyName(), 43200, function () {
            return $this->load(['sections.lessons.videos', 'sections.lessons.course'])->loadCount(['students', 'lessons']);
        });
    }

    public function clearCaches()
    {
        cache()->forget($this->getCacheKeyName());

        (new SchemaGenerator())->clearCourseCache($this->id);

        return true;
    }

    public function allGoals()
    {
        if (! $this->goals) return false;

        return preg_split("/\r\n|\n|\r/", $this->goals);
    }

    protected function getCacheKeyName()
    {
        return "course_lessons_{$this->id}";
    }
}
