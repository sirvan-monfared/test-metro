<?php

namespace App\Listeners;

use App\Services\Achievement\GrantAchievementService;
use LevelUp\Experience\Events\AchievementAwarded;

class LockAchievementProgression
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
    public function handle(AchievementAwarded $event): void
    {
        GrantAchievementService::lockProgressionFor($event->user, $event->achievement);
    }
}
