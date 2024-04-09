<?php

namespace App\Services;

use Illuminate\Http\Request;
use Conner\Tagging\Model\Tag;

class TagService
{
    public static $models = [\App\Models\Post::class, \App\Models\Podcast::class];

    public static function sync($taggable, Request $request) {
        $taggable->retag(self::prepareTagsToInsert($request->tags));
    }

    public static function findModels($tag) {
        $taggables = collect([]);
        
        foreach (self::$models as $model) {
            $items = $model::withAnyTag($tag->slug)->latest()->get();
            
            $taggables->push($items);
        }

        return $taggables->flatten();
    }

    public static function findBySlug($slug) {
        return Tag::where('slug', $slug)->first();
    }

    protected static function prepareTagsToInsert($tags) {
        return collect(json_decode($tags))->pluck('value')->toArray();
    }
}
