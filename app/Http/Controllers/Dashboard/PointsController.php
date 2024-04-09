<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\BreadCrumbService;
use LevelUp\Experience\Models\Achievement;

class PointsController extends Controller
{
    public function index()
    {
        return view('front.dashboard.point.index', [
            'history' => auth()->user()->xpHistory(),
            'total_points' => auth()->user()->getPoints(),
            'available_achievements' => Achievement::all(),
            'breadCrumbs' => BreadCrumbService::dashboardPoints()->items()
        ]);
    }
}
