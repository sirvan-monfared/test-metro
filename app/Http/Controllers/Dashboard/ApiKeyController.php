<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\BreadCrumbService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('meta');

        return view('front.dashboard.apikey.index', [
            'user' => $user,
            'breadCrumbs' => BreadCrumbService::dashboardApikey()->items()
        ]);
    }

    public function store()
    {
        abort_if(auth()->user()->hasApiKey(), 404);

        auth()->user()->generateApiKey();

        return back()->with('success', 'کد هویت سنجی با موفقیت ساخته شد');
    }
}
