<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExperienceReason;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserPointsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use LevelUp\Experience\Facades\Leaderboard;

class PointsController extends Controller
{
    public function index()
    {
        return view('admin.point.index', [
            'leaderboard' => Leaderboard::generate(paginate: false, limit: 20),
        ]);
    }

    public function create()
    {
        return view('admin.point.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'exp_points' => ['required', 'int'],
            'reason' => ['required']
        ]);

        try {
            $user = User::findOrFail($request->user_id);

            UserPointsService::addPoints(
                user: $user,
                points: $request->exp_points,
                reason: ExperienceReason::COURSE_ENROLLMENT->value,
                description: $request->reason
            );

            return back()->with('success', 'امتیاز با موفقیت به کاربر اعطا شد');

        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'کاربر موردنظر یافت نشد');
        }
    }
}
