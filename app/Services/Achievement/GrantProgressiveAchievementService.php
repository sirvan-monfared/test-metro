<?php

namespace App\Services\Achievement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use LevelUp\Experience\Models\Achievement;

class GrantProgressiveAchievementService
{

    public static function fourBuy(User $user)
    {
        $achievement = AchievementService::findByName('four-buys');

        if (!$achievement || !AchievementService::isProgressive($achievement) || self::has($user, $achievement)) return;

        if (!self::userAchievementRecord($user, $achievement)) {
            self::adduserAchievementRecord($user, $achievement);
            return;
        }

        // add progression
        self::incrementProgress($user, $achievement);
    }

    public static function has(User $user, Achievement $achievement): bool
    {
        $achievement = self::userAchievementRecord($user, $achievement);

        if (!$achievement) return false;

        if (AchievementService::isProgressFinished($achievement)) {
            return true;
        }

        return false;
    }

    public static function grantImmediately(User $user, Achievement $achievement): void
    {
        if (!AchievementService::isProgressive($achievement) || self::has($user, $achievement)) return;

        self::userAchievementRecord($user, $achievement)?->pivot->delete();;

        self::adduserAchievementRecord(
            user: $user,
            achievement: $achievement,
            progress_amount: 100
        );
    }

    private static function incrementProgress(User $user, Achievement|Model $achievement, $progress_amount = null): void
    {
        $user->incrementAchievementProgress(
            achievement: $achievement,
            amount: $progress_amount ?: AchievementService::progressAmountForEachStep($achievement)
        );
    }

    private static function adduserAchievementRecord(User $user, Achievement $achievement, int|null $progress_amount = null): void
    {
        $user->grantAchievement(
            achievement: $achievement,
            progress: $progress_amount ?: AchievementService::progressAmountForEachStep($achievement)
        );
    }

    private static function userAchievementRecord(User $user, Achievement $achievement): Model|null
    {
        return $user->achievementsWithProgress()->find($achievement->id);
    }
}
