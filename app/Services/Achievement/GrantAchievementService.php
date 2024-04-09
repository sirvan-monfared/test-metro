<?php

namespace App\Services\Achievement;

use App\Models\User;
use LevelUp\Experience\Models\Achievement;

class GrantAchievementService
{
    public static function profileInfoCompleted(User $user): void
    {
        self::findAndGrantAchievement($user, 'profile-info-completed');
    }

    public static function avatarUploaded(User $user): void
    {
        self::findAndGrantAchievement($user, 'avatar-uploaded');
    }

    public static function firstBuy(User $user): void
    {
        self::findAndGrantAchievement($user, 'first-buy');
    }

    public static function oneYearMemberShip(User $user): void
    {
        self::findAndGrantAchievement($user, 'one-year-membership');
    }

    public static function has(User $user, Achievement $achievement): bool
    {
        $achievement =  $user->allAchievements->find($achievement->id);

        if (! $achievement) return false;

        if (! AchievementService::isProgressive($achievement)) {
            return true;
        }

        if (AchievementService::isProgressFinished($achievement)) {
            return true;
        }

        return false;
    }

    public static function isProgressionLockedFor(User $user, Achievement $achievement): bool
    {
        $achievement = AchievementService::loadPivotFor($user, $achievement);

        return !! $achievement->pivot->completed_at;
    }

    public static function isProgressionAllowedFor(User $user, Achievement $achievement): bool
    {
        return ! self::isProgressionLockedFor($user, $achievement);
    }

    public static function lockProgressionFor(User $user, Achievement $achievement): void
    {
        $achievement = AchievementService::loadPivotFor($user, $achievement);

        $achievement->pivot->completed_at = now();
        $achievement->pivot->save();
    }

    public static function hasUserFinishedProgression(User $user, Achievement $achievement): bool
    {
        $achievement = AchievementService::loadPivotFor($user, $achievement);

        return AchievementService::isProgressFinished($achievement);
    }


    public static function grantAchievement(User $user, Achievement $achievement): void
    {
        if (self::has($user, $achievement)) return;

        try {
            $user->grantAchievement($achievement);

        } catch (\Exception $e) {
            return;
        }
    }

    private static function findAndGrantAchievement(User $user, string $achievement_name): void
    {
        $achievement = AchievementService::findByName($achievement_name);

        if (!$achievement) return;

        self::grantAchievement(
            user: $user,
            achievement: $achievement
        );
    }


}
