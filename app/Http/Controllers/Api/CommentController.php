<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TooManyCommentsException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\RateLimiter;

class CommentController extends Controller
{
    /**
     * @param $request
     */
    protected function setUserNameIfNotExists($request): void
    {
        if (!auth()->user()->name && $request->name) {
            auth()->user()->updateName($request->name);
        }
    }

    protected function assureRateLimitFor($callback)
    {
        $saved = RateLimiter::attempt(
            'create-comment:'.auth()->id(),
            config('ratelimit.comment_per_minute'),
            $callback
        );

        if (!$saved) {
            throw new TooManyCommentsException();
        }

        return true;
    }
}
