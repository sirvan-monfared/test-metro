<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;

class ApiController extends Controller
{
    public function courses()
    {
        return response([
            'courses' => Course::all()
        ], 200);
    }

    public function sections(Course $course)
    {
        return response($course->sections->load('lessons'));
    }

    public function storeSection(Course $course)
    {
        $data = request('section');
        $section = $course->sections()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'order' => $data['order'] ?? 0
        ]);

        return response(['section' => $section->load('lessons')], 200);
    }

    public function updateSection(Course $course, Section $section)
    {
        $data = request('section');

        $section->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'order' => $data['order'] ?? 0
        ]);

        return response(['section' => $section], 200);
    }

    public function deleteSection(Section $section)
    {
        $section->delete();

        return response(['message' => 'success'], 200);
    }

    public function storeLesson(Course $course, Section $section)
    {
        $data = request('lesson');
        $lesson = $section->lessons()->create([
            'course_id' => $course->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'is_free' => $data['is_free'],
            'short_description' => $data['short_description'],
            'status' => 2
        ]);

        return response(['lesson' => $lesson], 200);
    }

    public function updateLesson(Course $course, Section $section, Lesson $lesson)
    {
        $data = request('lesson');
        $lesson->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'is_free' => $data['is_free'],
            'short_description' => $data['short_description']
        ]);

        return response(['lesson' => $lesson], 200);
    }

    public function users()
    {
        $keyword = request()->keyword;

        return User::where('phone', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('name', 'LIKE', "%{$keyword}%")
                ->latest()
                ->get()
                ->map( fn ($item) => ['id' => $item->id, 'name' => $item->publicName() ] );
    }
}
