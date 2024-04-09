<?php

namespace App\Services;

use App\Enums\ExerciseStatus;
use App\Filters\Entities\ExerciseFilter;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ExerciseService
{

    public static function filter(Request $request, ExerciseFilter $filter)
    {
        if (! $request->status) {
            $request->merge([
                'status' => 1
            ]);
        }

        return Exercise::with(['course', 'student'])->filter($filter)->orderBy('status', 'asc')->latest()->get();
    }

    public static function for(User $user, Course $course): Collection
    {
        return $user->exercises()->where('course_id', $course->id)->latest()->get();
    }

    public static function create(User $user, Course $course, $title, $description, $link = null): Exercise
    {
        $exercise = $user->exercises()->create([
            'course_id' => $course->id,
            'title' => $title,
            'description' => $description,
            'link' => $link,
            'status' => ExerciseStatus::UNSEEN
        ]);

        TelegramNotificationService::newExerciseUploaded($exercise);

        return $exercise;
    }

    public static function update(Exercise $exercise, Request $request): void
    {
        $exercise->update([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'status' => $request->status,
            'review' => $request->review,
            'rating' => $request->rating,
            'public' => $request->boolean('public')
        ]);
    }

    public static function totalBetween($from, $to): int
    {
        return Exercise::query()
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->count('id');
    }
}
