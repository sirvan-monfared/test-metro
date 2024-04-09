<?php

namespace App\Http\Controllers;

use App\Kodesign\SchemaGenerator;
use App\Models\Course;
use App\Services\BreadCrumbService;
use Illuminate\View\View;
use \Jenssegers\Agent\Agent;

class CourseController extends Controller
{
    public function show(Course $course, SchemaGenerator $schema, Agent $agent): View
    {
        $course = $course->withLessons();

        $breadCrumbs = BreadCrumbService::course($course);


        $view = $agent->isMobile() ? 'front.course.show-mobile' : 'front.course.show-desktop';
        return view($view)->with([
            'course' => $course,
            'average_ratings'   => floatval(round($course->averageRatings(), 2)),
            'comments_count'    => number_format($course->publishedCommentsCount()),
            'isEnrolled'        => auth()->user()?->alreadyEnrolledIn($course) ?? false,
            'canReviewOnCourse' => auth()->user()?->canReviewOnCourse($course),
            'breadCrumbs'       => $breadCrumbs->items(),
            'page_schema'       => $schema->courseCached($course, $breadCrumbs)
        ]);
    }

    public function index(SchemaGenerator $schemaGenerator): View
    {
        $breadCrumbs = BreadCrumbService::courseIndex();

        return view('front.course.list')->with([
            'courses' => Course::list()->get(),
            'breadCrumbs' => $breadCrumbs->items(),
            'page_schema' => $schemaGenerator->breadCrumbs($breadCrumbs)->toScript()
        ]);
    }
}
