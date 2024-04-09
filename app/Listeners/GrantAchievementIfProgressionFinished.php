<?php

namespace App\Listeners;

use App\Services\Achievement\AchievementService;
use App\Services\Achievement\GrantAchievementService;
use LevelUp\Experience\Events\AchievementAwarded;
use LevelUp\Experience\Events\AchievementProgressionIncreased;

class GrantAchievementIfProgressionFinished
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AchievementProgressionIncreased $event): void
    {
        $achievement = AchievementService::loadPivotFor($event->user, $event->achievement);

        if (GrantAchievementService::isProgressionLockedFor($event->user, $achievement) || ! GrantAchievementService::hasUserFinishedProgression($event->user, $achievement)) {
            return;
        }

        AchievementAwarded::dispatch($achievement, $event->user);
    }
}
