<?php

namespace App\Http\Controllers;

use App\Services\BreadCrumbService;
use App\Services\TagService;

class TagController extends Controller
{
    public function show($tag) {

        $tagModel = TagService::findBySlug($tag);

        abort_if(! $tagModel, 404);
        
        $items = TagService::findModels($tagModel);

        $breadCrumbs = BreadCrumbService::tagIndex($tag);

        return view('front.tag.show', [
            'items' => $items,
            'tag' => $tagModel->name,
            'breadCrumbs' => $breadCrumbs->items()
        ]);
    }

    protected function isTypeValid($type) {
        return in_array($type, ['post', 'podcast']);
    }
}
