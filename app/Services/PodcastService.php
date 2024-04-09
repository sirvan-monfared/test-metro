<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastService
{
    public static function store(Request $request)
    {
        return Podcast::create(self::prepareEntitiesToSave($request));
    }

    public static function update(Podcast $podcast, Request $request)
    {
        return $podcast->update(self::prepareEntitiesToSave($request));
    }

    public static function destroy(Podcast $podcast)
    {
        return $podcast->delete();
    }

    public static function prepareEntitiesToSave(Request $request)
    {
        return [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => Status::from($request->status),
            'path' => $request->path,
            'duration' => $request->duration,
            'episode' => $request->episode,
            'seo' => $request->only(['seo__title', 'seo__description', 'seo__keywords']),
        ];
    }
}
