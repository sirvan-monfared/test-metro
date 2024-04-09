<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CampaignController extends Controller
{
    public function index()
    {
        return view('admin.campaign.index', [
            'campaigns' => Campaign::withCount('users')->paginate(20)
        ]);
    }

    public function create()
    {
        return view('admin.campaign.create', [
            'campaign' => new Campaign()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'slug' => ['required', Rule::unique('campaigns', 'slug')],
        ]);

        Campaign::create([
            'title' => $request->title,
            'slug' => $request->slug
        ]);

        return back()->withSuccess('ساخت کمپین با موفقیت انجام شد');
    }

    public function update(Campaign $campaign, Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'slug' => ['required', Rule::unique('campaigns', 'slug')->ignore($campaign)]
        ]);

        $campaign->update([
            'title' => $request->title,
            'slug' => $request->slug
        ]);

        return back()->withSuccess('ویرایش کمپین با موفقیت انجام شد');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaign.edit', [
            'campaign' => $campaign
        ]);
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        session()->flash('success', "حذف کمپین {$campaign->title} با موفقیت انجام شد");
        return response()->noContent(200);
    }
}
