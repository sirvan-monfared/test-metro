<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Kodesign\BreadCrumbs;
use App\Models\Podcast;
use App\Services\BreadCrumbService;

class PodcastController extends Controller
{
    public function index(BreadCrumbs $breadCrumbs)
    {
        return view('front.podcast.index', [
            'podcasts' => Podcast::latest()->paginate(20),
            'breadCrumbs' => BreadCrumbService::podcastIndex()->items()
        ]);
    }

    public function show(Podcast $podcast)
    {
        abort_if($podcast->status !== Status::ACTIVE && !auth()->user()?->isAdmin(), 403);
//        $this->authorize('status-active', $podcast);
        $podcast->increment('views');

        return view('front.podcast.show', [
            'podcast' => $podcast,
            'tags' => $podcast->load('tagged')->tagged,
            'breadCrumbs' => BreadCrumbService::podcast($podcast)->items(),
            'comments_count' => number_format($podcast->publishedCommentsCount())
        ]);
    }
}
