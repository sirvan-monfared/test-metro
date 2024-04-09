<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use App\Services\TelegramNotificationService;

class ReportController extends Controller
{
    public function income() {
        return view('admin.report.income');
    }

    public function userRegister() {
        return view('admin.report.user-register');
    }

}
