<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExerciseStatus;
use App\Events\ExerciseReviewed;
use App\Filters\Entities\ExerciseFilter;
use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExerciseController extends Controller
{
    public function index(Request $request, ExerciseFilter $filter)
    {
        return view('admin.exercise.index', [
            'exercises' => ExerciseService::filter($request, $filter)
        ]);
    }

    public function edit(Exercise $exercise)
    {
        return view('admin.exercise.edit', [
            'exercise' => $exercise
        ]);
    }

    public function update(Exercise $exercise, Request $request)
    {
        $request->validate([
            'course_id' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'link' => [],
            'status' => ['required', Rule::in(ExerciseStatus::cases())],
            'review' => [Rule::requiredIf(intval($request->status) === ExerciseStatus::REVIEWED->value)],
            'rating' => [Rule::requiredIf(intval($request->status) === ExerciseStatus::REVIEWED->value)],
        ]);

        ExerciseService::update($exercise, $request);

        if ($exercise->fresh()->isReviewed()) {
            event(new ExerciseReviewed($exercise, $exercise->student));
        }

        return back()->with('success', 'ویرایش با موفقیت انجام شد');
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return response("حذف تمرین با شناسه {$exercise->id} با موقیت انجام شد", 200);
    }
}
