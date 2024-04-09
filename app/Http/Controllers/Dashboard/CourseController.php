<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\BreadCrumbService;
use App\Services\ExerciseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function index()
    {
        return view('front.dashboard.course.index')->with([
            'courses' => auth()->user()->activeCourses,
            'breadCrumbs' => BreadCrumbService::dashboardCourses()->items()
        ]);
    }

    public function show(Course $course)
    {
        Gate::allowIf(fn ($user) => $user->alreadyEnrolledIn($course) || $user->isAdmin());

        $course = $course->withLessons();

        return view('front.dashboard.course.show')->with([
            'course' => $course,
            'exercises' => ExerciseService::for(auth()->user(), $course),
            'breadCrumbs' => BreadCrumbService::dashboardCourse($course)->items()
        ]);
    }
}
