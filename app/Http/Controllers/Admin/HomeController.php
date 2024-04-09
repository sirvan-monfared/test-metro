<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ChartService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.home', [
            'incomeChartData' => ChartService::incomeChart(from: now()->subDays(6), to: now(), format_date: 'm/d'),
            'registerChartData' => ChartService::usersRegisterChart(from: now()->subDays(6), to: now(), format_date: 'm/d'),
        ]);
    }
}
