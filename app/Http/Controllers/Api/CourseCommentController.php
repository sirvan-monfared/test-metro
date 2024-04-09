<?php

namespace App\Http\Controllers\Api;

use App\Enums\CommentType;
use App\Exceptions\TooManyCommentsException;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Course;
use App\Services\CommentService;
use App\Services\TelegramNotificationService;

class CourseCommentController extends CommentController
{
    public function index(Course $course): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CommentResource::collection($course->publishedReviews(request()->limit));
    }

    public function store(Course $course, CommentRequest $request)
    {
        try {
            $this->setUserNameIfNotExists($request);

            $this->assureRateLimitFor(fn () => CommentService::store(CommentType::REVIEW, $course, $request));

            TelegramNotificationService::newCommentCreated($course);
        } catch (TooManyCommentsException $e) {
            return response(['message' => $e->message()], 429);
        }

        return response(['message' => 'متشکرم. نظرت ثبت شد و بعد از تایید مدیر سایت نمایش داده میشه'], 200);
    }

    public function info(Course $course)
    {
        return $course->reviewsInfo();
    }
}
