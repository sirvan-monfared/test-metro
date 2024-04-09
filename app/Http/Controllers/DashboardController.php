<?php

namespace App\Http\Controllers;

use App\Services\BreadCrumbService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('front.dashboard.index')->with([
            'courses_count' => auth()->user()->activeCourses()->count(),
            'latest_courses' => auth()->user()->activeCourses()->latest()->take(2)->get(),
            'breadCrumbs' => BreadCrumbService::dashboard()->items()
        ]);
    }
}
