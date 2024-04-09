<?php

namespace App\Kodesign;

use App\Models\Course;
use App\Models\Post;
use Illuminate\Support\Collection;
use Spatie\SchemaOrg\Product;
use Spatie\SchemaOrg\Schema;

class SchemaGenerator
{

    public $schema;

    public function course(Course $course): self
    {
        $review = $course->randomReview();

        $this->schema = Schema::product()
            ->name($course->alter_name ?: $course->title)->image($course->featuredImage())
            ->description($course->short_description)
            ->brand('لاراپلاس')
            ->aggregateRating(
                Schema::aggregateRating()
                    ->ratingValue($course->averageRatings())
                    ->reviewCount($course->publishedCommentsCount())
                    ->bestRating(5)
                    ->worstRating(1)
            )
            ->if($review, function (Product $schema) use ($review) {
                $schema->review(
                    Schema::review()
                        ->reviewRating(Schema::rating()->ratingValue($review->rating)->bestRating(5)->worstRating(1))
                        ->author(Schema::person()->name($review->user->name))
                );
            });


        return $this;
    }

    public function breadCrumbs(BreadCrumbs $breadCrumbs): self
    {
        $output = [];
        foreach ($breadCrumbs->items() as $item) {
            $output[] = Schema::listItem()->position($item['position'])->name($item['name'])->item($item['item']);
        }

        $this->schema = Schema::breadcrumbList()->itemListElement($output);

        return $this;
    }

    public function blogPost(Post $post): self
    {
        $this->schema = Schema::blogPosting()
            ->mainEntityOfPage(
                Schema::webPage()->setProperty('@id', $post->viewLink())
            )
            ->headline($post->title)
            ->author(
                Schema::person()->name('سیروان منفرد')
            )
            ->datePublished($post->created_at->format('Y-m-d'))
            ->dateModified($post->updated_at->format('Y-m-d'));

        return $this;
    }

    public function faqs(Collection $faqs): self|bool
    {
        if ($faqs->count() < 1) return $this;

        $output = [];
        foreach ($faqs as $faq) {
            $output[] = Schema::question()->name($faq->title)->acceptedAnswer(Schema::answer()->text($faq->body));
        }

        $this->schema = Schema::fAQPage()
            ->mainEntity(
                $output
            );

        return $this;
    }

    public function siteNavigation(): self
    {
        $this->schema = Schema::itemList()
            ->itemListElement([
                Schema::siteNavigationElement()->position(1)->name('لیست دوره ها')->url(route('course.list'))->description('دوره های آموزش برنامه نویسی لاراپلاس'),
                Schema::siteNavigationElement()->position(2)->name('ورود')->url(route('login'))->description('ثبت نام در لاراپلاس | ورود به حساب کاربری'),
                Schema::siteNavigationElement()->position(3)->name('بلاگ')->url(route('front.blog'))->description('مطالب آموزش برنامه نویسی در وبلاگ لاراپلاس'),
                Schema::siteNavigationElement()->position(4)->name('پادکست ها')->url(route('front.podcast'))->description('پادکست های برنامه نویسی لاراپلاس'),
                Schema::siteNavigationElement()->position(5)->name('درباره ما')->url(route('front.about'))->description('درباره لاراپلاس - سیروان منفرد'),
            ]);


        return $this;
    }

    public function courseCached(Course $course, BreadCrumbs $breadCrumbs)
    {
        return cache()->remember(
            $this->courseCacheKey($course->id),
            86400,
            fn () => $this->course($course)->toScript() . $this->breadCrumbs($breadCrumbs)->toScript() . $this->faqs($course->faqs)->toScript()
        );
    }

    public function clearCourseCache($courseId)
    {
        cache()->forget($this->courseCacheKey($courseId));
    }

    public function toScript()
    {
        return $this->schema?->toScript();
    }

    protected function courseCacheKey($courseId)
    {
        return "course_schema_{$courseId}";
    }
}
