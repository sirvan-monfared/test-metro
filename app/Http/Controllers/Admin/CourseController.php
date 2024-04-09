<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Section;
use App\Services\CourseService;
use App\Services\FaqService;
use Illuminate\Contracts\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        return view('admin.course.index')->with([
            'courses' => Course::withCount('activeStudents')
                                ->latest()
                                ->paginate(20)
                                ->withQueryString(),
        ]);
    }

    public function create(): View
    {
        return view('admin.course.create')->with([
            'course' => new Course(),
            'categories' => Category::all(),
        ]);
    }

    public function edit(Course $course)
    {
        $course->load('sections.lessons');

        return view('admin.course.edit')->with([
            'course' => $course,
            'categories' => Category::all(),
        ]);
    }

    public function store(CourseRequest $request): \Illuminate\Http\RedirectResponse
    {
        $course = CourseService::create($request);
        
        // CourseService::syncCategories($course, $request->categories);

        $this->uploadImage($course);

        FaqService::store($course, $request);

        return redirect()->back()->with('success', 'operation successful');;
    }

    public function update(CourseRequest $request, Course $course): \Illuminate\Http\RedirectResponse
    {
        CourseService::update($course, $request);

        // CourseService::syncCategories($course, $request->categories);

        $this->uploadImage($course);

        $this->updateLessons($request->lessons);

        FaqService::store($course, $request);

        return redirect()->back()->with('success', 'operation successful');
    }

    protected function uploadImage(Course $course): void
    {
        if (!$image = request()->file('featured_image')) {
            return;
        }

        $image_name = time().'.'.$image->extension();
        $image->move(public_path('images'), $image_name);
        $course->featured_image = $image_name;
        $course->save();
    }

    protected function updateLessons($lessons): void
    {
        $items = json_decode($lessons);

        foreach ($items as $item) {
            $syncData = [];
            foreach ($item->lessons as $lesson) {
                $syncData[$lesson->lesson_id] = ['order' => $lesson->order];
            }

            Section::find($item->section_id)->lessons()->sync($syncData);
        }
    }
}
