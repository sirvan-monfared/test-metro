<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Entities\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\Achievement\AchievementService;

class UserController extends Controller
{
    public function index(UserFilter $filter): \Illuminate\Contracts\View\View
    {
        return view('admin.user.index')->with([
            'users' => User::withCount('activeCourses')
                            ->filter($filter)
                            ->latest()
                            ->paginate(20)
                            ->withQueryString(),
        ]);
    }

    public function show(User $user)
    {
//        GrantAchievementService::grantAchievement($user, AchievementService::findByName('avatar-uploaded'));
//        $user->incrementAchievementProgress(AchievementService::findByName('four-buys'), 20);

        $user->loadCount('activeCourses');

        return view('admin.user.show', [
            'user' => $user,
            'total_payments' => $user->totalPayments(),
            'enrollments_count' => $user->active_courses_count,
            'comments' => $user->comments()->take(5)->get(),
            'available_achievements' => AchievementService::availableAchievements()
        ]);
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('admin.user.create')->with([
            'user' => new User(),
        ]);
    }

    public function edit(User $user): \Illuminate\Contracts\View\View
    {
        return view('admin.user.edit')->with([
            'user' => $user,
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_verified' => true,
            'email_verified_at' => $request->email ? now() : null,
            'phone_verified_at' => $request->phone ? now() : null,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'عملیات با موفقیت انجام شد');
    }

    public function update(UserRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_verified' => true,
            'email_verified_at' => $user->hasVerifiedEmail() ? $user->email_verified_at : now(),
            'phone_verified_at' => $user->hasVerifiedPhone() ? $user->phone_verified_at : now(),
        ]);

        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return back()->with('success', 'ویرایش با موفقیت انجام شد');
    }
}
