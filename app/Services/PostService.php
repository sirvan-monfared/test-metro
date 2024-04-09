<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Post;
use Illuminate\Http\Request;

class PostService
{
    public static function store(Request $request)
    {
        return Post::create(self::prepareEntitiesToSave($request));
    }

    public static function update(Post $post, Request $request)
    {
        return $post->update(self::prepareEntitiesToSave($request));
    }

    public static function prepareEntitiesToSave(Request $request)
    {
        return [
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => str_replace('<code', '<code v-pre ', $request->body),
            'short' => $request->short,
            'status' => Status::from($request->status),
            'seo' => $request->only(['seo__title', 'seo__description', 'seo__keywords'])
        ];
    }
}
