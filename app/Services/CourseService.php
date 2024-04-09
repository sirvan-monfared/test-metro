<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseService
{
    public static function create(Request $request): Course|false
    {
        return Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'alter_name' => $request->alter_name,
            'price' => $request->price,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'goals' => $request->goals,
            'duration' => $request->duration,
            'level' => $request->level,
            'discount_type' => $request->discount_type,
            'discount_amount' => correctDiscount($request->discount_amount),
            'preview_video' => $request->preview_video,
            'project_link' => $request->project_link,
            'status' => $request->status,
            'record_status' => $request->record_status,
            'exp_points' => intval($request->exp_points),
            'seo' => $request->only(['seo__title', 'seo__description', 'seo__keywords', 'seo__schema']),
        ]);
    }

    public static function update(Course $course, Request $request): Course
    {
        $course->update([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'alter_name' => $request->alter_name,
            'price' => $request->price,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'goals' => $request->goals,
            'duration' => $request->duration,
            'level' => $request->level,
            'discount_type' => $request->discount_type,
            'discount_amount' => correctDiscount($request->discount_amount),
            'preview_video' => $request->preview_video,
            'project_link' => $request->project_link,
            'status' => $request->status,
            'record_status' => $request->record_status,
            'exp_points' => intval($request->exp_points),
            'seo' => $request->only(['seo__title', 'seo__description', 'seo__keywords', 'seo__schema']),

        ]);

        $course->clearCaches();

        return $course;
    }

    public static function syncCategories(Course $course, $categories): void
    {
        $course->categories()->sync($categories);
    }
}
