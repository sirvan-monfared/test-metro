<?php

namespace App\Http\Controllers\Api;

use App\Enums\CommentType;
use App\Exceptions\TooManyCommentsException;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Podcast;
use App\Services\CommentService;
use App\Services\TelegramNotificationService;

class PodcastCommentController extends CommentController
{
    public function index(Podcast $podcast): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CommentResource::collection($podcast->publishedCommentsWithChildren());
    }

    public function store(Podcast $podcast, CommentRequest $request)
    {
        try {
            $this->setUserNameIfNotExists($request);

            $this->assureRateLimitFor(fn () => CommentService::store(CommentType::COMMENT, $podcast, $request));

            TelegramNotificationService::newCommentCreated($podcast);
        } catch (TooManyCommentsException $e) {
            return response(['message' => $e->message()], 429);
        }

        return response(['message' => 'متشکرم. نظرت ثبت شد و بعد از تایید مدیر سایت نمایش داده میشه'], 200);
    }
}
