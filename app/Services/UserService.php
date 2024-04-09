<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public static function updateMetaInfos(User $user, Request $request): void
    {
        $user->meta()->updateOrCreate([
            'telegram_id' => $request->telegram_id,
            'education' => $request->education,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
        ]);
    }

    public static function totalRegisterCount($from, $to): int
    {
        return User::query()
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->count('id');
    }

    public static function hasCompleteProfileInfo(User $user): bool
    {
        if (empty($user->name)) {
             return false;
        };

        if (! $user->meta->telegram_id || ! $user->meta->education || ! $user->meta->birth_date || ! $user->meta->gender) {
            return false;
        }

        return true;
    }
}
