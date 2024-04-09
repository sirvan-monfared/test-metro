<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AlreadyEnrolledException;
use App\Filters\Entities\EnrollmentFilter;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use App\Services\ManualEnrollmentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index(EnrollmentFilter $filter)
    {
        return view('admin.enrollment.index')->with([
            'enrollments' => Enrollment::with(['student', 'course', 'order'])
                                ->filter($filter)
                                ->latest()
                                ->paginate(20)
                                ->withQueryString(),
        ]);
    }

    public function show(Enrollment $enrollment)
    {
        return view('admin.enrollment.show')->with([
            'enrollment' => $enrollment,
        ]);
    }

    public function create()
    {
        return view('admin.enrollment.create')->with([
            'courses' => Course::latest()->get(['title', 'id']),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => ['required'],
            'user_id' => ['required'],
            'price' => ['required'],
        ]);

        try {
            ManualEnrollmentService::enroll(
                user: User::findOrFail($request->user_id),
                course: Course::findOrFail($request->course_id),
                price: $request->price,
                description: $request->description
            );

            return redirect()->route('admin.enrollment.index')->with('success', 'ثبت نام با موفقیت انجام شد');
        }  catch (AlreadyEnrolledException $e) {
            return redirect()->back()->with('error', 'این کاربر قبلا در دوره انتخابی ثبت نام کرده است');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'یافت نشد');
        }
    }
}
