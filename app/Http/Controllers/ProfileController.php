<?php

namespace App\Http\Controllers;

use App\Events\ProfileUpdated;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Services\BreadCrumbService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function edit()
    {
        $breadCrumbs = BreadCrumbService::profileEdit();

        return view('front.dashboard.profile.edit', [
            'user' => auth()->user(),
            'breadCrumbs' => $breadCrumbs->items()
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        $user->updateName($request->name);

        UserService::updateMetaInfos($user, $request);

        $this->uploadImage($user);

        event(new ProfileUpdated($user));

        return back()->with('success', 'ویرایش اطلاعات کاربری با موفقیت انجام شد');
    }

    protected function uploadImage(User $user): void
    {
        if (! $image = request()->file('avatar')) {
            return;
        }

        $image_name = time().'.'.$image->extension();
        $upload_path = public_path('images/users/') . $image_name;

        [$width, $height] = explode('x', config('image.avatar_size'));
        \Image::make($image)->resize($width, $height)->save($upload_path);

        $user->featured_image = $image_name;
        $user->save();
    }

    public function editName()
    {
        $breadCrumbs = BreadCrumbService::profileEdit();

        return view('front.dashboard.profile.editName', [
            'breadCrumbs' => $breadCrumbs->items()
        ]);
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5'
        ], [
            'name.*' => 'لطفا نام و نام خانوادگی خود را وارد بدرستی وارد کنید'
        ]);

        auth()->user()->update([
            'name' => $request->name,
        ]);

        return redirect()->intended(route('dashboard'));
    }
}
