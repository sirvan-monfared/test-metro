<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Entities\PodcastFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PodcastRequest;
use App\Models\Podcast;
use App\Services\PodcastService;
use App\Services\TagService;

class PodcastController extends Controller
{
    public function index(PodcastFilter $filter)
    {
        return view('admin.podcast.index', [
            'podcasts' => Podcast::filter($filter)->latest()->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.podcast.create', [
            'podcast' => new Podcast(),
            'tags' => collect([])
        ]);
    }

    public function store(PodcastRequest $request)
    {
        $podcast = PodcastService::store($request);

        TagService::sync($podcast, $request);

        return redirect()->route('admin.podcast.edit', $podcast)->with('success', 'ثبت پادکست جدید با موفقیت انجام شد');
    }

    public function edit(Podcast $podcast)
    {
        return view('admin.podcast.edit', [
            'podcast' => $podcast,
            'tags' => $podcast->tags->pluck('name')
        ]);
    }

    public function update(PodcastRequest $request, Podcast $podcast)
    {
        PodcastService::update($podcast, $request);

        TagService::sync($podcast, $request);

        return back()->with('success', 'ویرایش با موفقیت انجام شد');
    }

    public function destroy(Podcast $podcast)
    {
        PodcastService::destroy($podcast);

        session()->put('success', 'حذف با موفقیت انجام شد');
        return response('', 200);
    }
}
