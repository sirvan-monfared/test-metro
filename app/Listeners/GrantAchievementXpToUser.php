<?php

namespace App\Listeners;

use App\Services\UserPointsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use LevelUp\Experience\Events\AchievementAwarded;

class GrantAchievementXpToUser
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
        UserPointsService::achievementReached($event->achievement, $event->user);
    }
}
