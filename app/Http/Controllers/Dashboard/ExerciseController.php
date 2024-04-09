<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseRequest;
use App\Kodesign\BreadCrumbs;
use App\Models\Course;
use App\Models\Exercise;
use App\Services\BreadCrumbService;
use App\Services\ExerciseService;
use App\Services\FileService;
use App\Services\UploadFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExerciseController extends Controller
{

    public function show(Exercise $exercise)
    {
        return view('front.dashboard.exercise.show', [
            'exercise' => $exercise,
            'breadCrumbs' => BreadCrumbService::dashboardShowExercise($exercise->course)->items()
        ]);
    }

    public function create(Course $course)
    {
        return view('front.dashboard.exercise.create', [
            'course' => $course,
            'breadCrumbs' => BreadCrumbService::dashboardCreateExercise($course)->items()
        ]);
    }

    public function store(ExerciseRequest $request, Course $course)
    {
        $exercise = ExerciseService::create(
            user: auth()->user(),
            course: $course,
            title: $request->title,
            description: $request->description,
            link: $request->link
        );

        if (!empty($request->filepond_file)) {
            $file = FileService::create(
                user: auth()->user(),
                model: $exercise,
                path: $request->filepond_file
            );
        }

        if (!empty($request->filepond_all_files)) {
            UploadFileService::clearTemp(
                file_paths: $request->filepond_all_files,
                exclude: $file?->path
            );
        }

        return back()->with('success', 'از اینکه تمرین رو جدی میگیری خیلی خوشحالم! در اولین فرصت این تمرین رو بررسی میکنم و بهت بازخورد میدم.');
    }

    public function upload(Request $request, Course $course)
    {
        $validator = $this->validateUploadedFile($request);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 302);
        }

        $path = UploadFileService::upload($request->file('file'));

        return response()->json([
            'path' => $path
        ], 201);
    }

    protected function validateUploadedFile(Request $request)
    {
        return Validator::make($request->all(), [
            'file' => [
                'required',
                'mimetypes:application/zip, application/octet-stream, application/x-zip-compressed, multipart/x-zip',
                'mimes:zip',
                'max:5000'
            ],
        ], [
            'file.required' => 'ارسال فایل الزامی است',
            'file.mimetypes' => 'فایل ارسالی باید از نوع zip باشد',
            'file.mimes' => 'فایل ارسالی باید از نوع zip باشد',
            'max' => 'حجم فایل ارسالی بیشتر از حد مجاز :max کیلوبایت است'
        ]);
    }
}
