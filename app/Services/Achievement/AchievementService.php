<?php

namespace App\Services\Achievement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use LevelUp\Experience\Models\Achievement;

class AchievementService
{
    public static function loadPivotFor(User $user, Achievement $achievement): Achievement|Model
    {
        if ($achievement->pivot) return $achievement;

        $achievementWithPivot = $user->allAchievements()->find($achievement->id);

        return $achievementWithPivot ?: $achievement;
    }

    public static function isProgressive(Achievement $achievement): bool
    {
        return $achievement->has_progress === 1;
    }

    public static function isProgressFinished(Achievement|Model $achievement): bool
    {
        return $achievement->pivot?->progress === 100;
    }

    public static function findByName(string $achievement_name)
    {
        return Achievement::where('name', $achievement_name)->first();
    }

    public static function availableAchievements(): Collection
    {
        return Achievement::all();
    }

    public static function progressAmountForEachStep(Achievement $achievement)
    {
        return intval(100 / $achievement->steps);
    }
}
