<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Entities\CampaignParticipationFilter;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Participation;

class CampaignParticipationController extends Controller
{
    public function index(CampaignParticipationFilter $filter)
    {
        $participations = Participation::filter($filter)->with(['campaign', 'user'])->latest('id')->paginate(20);

        return view('admin.campaign.participation.index', [
            'campaigns' => Campaign::all(),
            'participations' => $participations
        ]);
    }
}
