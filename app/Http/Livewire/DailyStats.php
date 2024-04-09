<?php

namespace App\Http\Livewire;

use App\Enums\CommentStatus;
use App\Models\Comment;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\User;
use App\Services\EnrollmentService;
use App\Services\OrderService;
use App\Services\UserService;
use Livewire\Component;

class DailyStats extends Component
{
    public function render()
    {
        $from = startOfJalaliDay();
        $to = endOfJalaliDay();

        return view('livewire.daily-stats', [
            'enrollments' => EnrollmentService::totalBetween($from, $to),
            'orders' => OrderService::totalIncome($from, $to),
            'users' => UserService::totalRegisterCount($from, $to),
            'comments' => Comment::where('status', CommentStatus::INACTIVE)->count(),
        ]);
    }
}
