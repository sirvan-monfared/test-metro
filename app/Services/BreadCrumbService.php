<?php

namespace App\Services;

use App\Kodesign\BreadCrumbs;
use App\Models\Course;
use App\Models\Order;
use App\Models\Podcast;
use App\Models\Post;

class BreadCrumbService
{
    public static function start(): BreadCrumbs
    {
        return new BreadCrumbs();
    }

    public static function dashboard(): BreadCrumbs
    {
        return (new BreadCrumbs())->withDashboard();
    }

    public static function courseIndex(): BreadCrumbs
    {
        return self::start()->add(2, 'دوره های آموزشی', route('course.list'));
    }

    public static function course(Course $course): BreadCrumbs
    {
        return self::start()->add(2, 'دوره های آموزشی', route('course.list'))
            ->add(3, $course->title, $course->viewLink());
    }

    public static function blogIndex(): BreadCrumbs
    {
        return self::start()->add(2, 'بلاگ', route('front.blog'));
    }

    public static function blogPost(Post $post): BreadCrumbs
    {
        return self::start()->add(2, 'بلاگ', route('front.blog'))
            ->add(3, $post->title, $post->viewLink());
    }

    public static function podcastIndex(): BreadCrumbs
    {
        return self::start()->add(2, 'پادکست های برنامه نویسی', route('front.podcast'));
    }

    public static function podcast(Podcast $podcast): BreadCrumbs
    {
        return self::start()->add(2, 'پادکست های برنامه نویسی', route('front.podcast'))
            ->add(3, $podcast->title, $podcast->viewLink());
    }

    public static function tagIndex(string $tagSlug): BreadCrumbs
    {
        return self::start()->add(2, $tagSlug, route('tag.show', $tagSlug));
    }

    public static function dashboardCourses(): BreadCrumbs
    {
        return self::dashboard()->add(3, 'دوره های من', route('dashboard.course.index'));
    }

    public static function dashboardCourse(Course $course, $with_link = false): BreadCrumbs
    {
        $link = $with_link ? route('dashboard.course', $course) :null;
        
        return self::dashboardCourses()->add(4, $course->title, $link);
    }

    public static function dashboardOrderHistory(): BreadCrumbs
    {
        return self::dashboard()->add(3, 'سوابق پرداخت', route('dashboard.order.history'));
    }

    public static function dashboardOrder(Order $order): BreadCrumbs
    {
        return self::dashboard()->add(3, 'سوابق پرداخت', route('dashboard.order.history'))
            ->add(4, 'مشاهده صورتحساب');
    }

    public static function dashboardPoints(): BreadCrumbs
    {
        return self::dashboard()->add(3, 'امتیازها', route('dashboard.point.index'));
    }

    public static function dashboardApikey(): BreadCrumbs
    {
        return self::dashboard()->add(3, 'کد هویت سنجی', route('dashboard.apikey.index'));
    }

    public static function dashboardCreateExercise(Course $course)
    {
        return self::dashboardCourse($course, true)->add(5, 'ارسال تمرین');
    }

    public static function dashboardShowExercise(Course $course)
    {
        return self::dashboardCourse($course, true)->add(5, 'مشاهده تمرین');
    }

    public static function cartIndex(): BreadCrumbs
    {
        return self::start()->add(2, 'سبد خرید', route('cart.show'));
    }

    public static function profileEdit(): BreadCrumbs
    {
        return self::dashboard()->add(3, 'ویرایش اطلاعات کاربری', route('dashboard.profile.editName'));
    }
}
