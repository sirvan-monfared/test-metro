<?php

namespace App\Http\Controllers\Api;

use App\Enums\CommentType;
use App\Exceptions\TooManyCommentsException;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Services\CommentService;
use App\Services\TelegramNotificationService;

class PostCommentController extends CommentController
{
    public function index(Post $post): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CommentResource::collection($post->publishedCommentsWithChildren());
    }

    public function store(Post $post, CommentRequest $request)
    {
        try {
            $this->setUserNameIfNotExists($request);

            $this->assureRateLimitFor(fn () => CommentService::store(CommentType::COMMENT, $post, $request));

            TelegramNotificationService::newCommentCreated($post);
        } catch (TooManyCommentsException $e) {
            return response(['message' => $e->message()], 429);
        }

        return response(['message' => 'متشکرم. نظرت ثبت شد و بعد از تایید مدیر سایت نمایش داده میشه'], 200);
    }
}
