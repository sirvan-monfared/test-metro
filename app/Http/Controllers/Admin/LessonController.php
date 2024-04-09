<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class LessonController extends Controller
{

    public function index() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('admin.lesson.index')->with([
            'lessons' => Lesson::all()
        ]);
    }

    public function forCourse(Course $course) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $sections = $course->lessons->groupBy(fn($lesson) => $lesson->section()?->id );

        return view('admin.lesson.index')->with([
            'course' => $course,
            'sections' => $sections
        ]);
    }

    public function create() : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('admin.lesson.create')->with([
            'lesson' => new Lesson()
        ]);
    }


    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'course_id' => ['required', 'integer'],
            'section_id' => ['required', 'integer'],
            'duration' => ['required'],
            'description' => [],
            'short_description' => [],
            'is_free' => [],
            'status' => ['integer'],
        ]);

        $lesson = Lesson::create([
            'title' => $attributes['title'],
            'course_id' => $attributes['course_id'],
            'duration' => $attributes['duration'],
            'description' => $attributes['description'],
            'short_description' => $attributes['short_description'],
            'is_free' => request()->has('is_free'),
            'status' => 2
        ]);
        $lesson->sections()->sync($attributes['section_id']);
        $lesson->files()->createMany($this->collectLessonFiles($request));

        $lesson->course->clearCaches();

        return redirect()->back()->with([
            'success' => 'operation success'
        ]);
    }

    public function edit(Lesson $lesson) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('admin.lesson.edit')->with([
            'lesson' => $lesson
        ]);
    }

    public function update(Request $request, Lesson $lesson)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:3'],
            'course_id' => ['required', 'integer'],
            'section_id' => ['required', 'integer'],
            'duration' => ['required'],
            'description' => [],
            'short_description' => [],
            'is_free' => [],
            'status' => ['integer'],
        ]);

        $lesson->update([
            'title' => $attributes['title'],
            'course_id' => $attributes['course_id'],
            'duration' => $attributes['duration'],
            'description' => $attributes['description'],
            'short_description' => $attributes['short_description'],
            'is_free' => $request->has('is_free')
        ]);

        $lesson->sections()->sync($attributes['section_id']);
        $lesson->files()->delete();
        $lesson->files()->createMany($this->collectLessonFiles($request));

        $lesson->course->clearCaches();

        return redirect()->back()->with([
            'success' => 'operation success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }

    protected function collectLessonFiles($request): array|Collection
    {
        if (! $request->has('file_type') || ! $request->has('file_path')) return [];

        $lesson_files = collect(array_map(null, $request->get('file_type'), $request->get('file_path')));

        return $lesson_files->map(function($item) {
            return [
                'type' => $item[0],
                'path' => $item[1]
            ];
        });
    }
}
