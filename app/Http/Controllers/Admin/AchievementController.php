<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Achievement\AchievementService;
use App\Services\Achievement\GrantAchievementService;
use App\Services\Achievement\GrantProgressiveAchievementService;
use Illuminate\Http\Request;
use LevelUp\Experience\Models\Achievement;

class AchievementController extends Controller
{
    public function create()
    {
        return view('admin.achievement.create', [
            'available_achievements' => Achievement::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'achievement_name' => 'required',
            'user_id' => 'required'
        ]);

        $user = User::find($request->user_id);
        $achievement = Achievement::where('name', $request->achievement_name)->first();

        if (GrantAchievementService::has($user, $achievement)) {
            return back()->with('error', 'نشان مورد نظر قبلا توسط این کاربر دریافت شده است');
        }

        if (AchievementService::isProgressive($achievement)) {
            GrantProgressiveAchievementService::grantImmediately($user, $achievement);
        } else {
            GrantAchievementService::grantAchievement($user, $achievement);
        }



        return back()->with('success', 'نشان افتخار به کاربر اعطا شد');
    }
}
