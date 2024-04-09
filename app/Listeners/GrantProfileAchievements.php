<?php

namespace App\Listeners;

use App\Services\Achievement\GrantAchievementService;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GrantProfileAchievements
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
    public function handle(object $event): void
    {
        if ($event->user->hasFeaturedImage()) {
            GrantAchievementService::avatarUploaded($event->user);
        }

        if (UserService::hasCompleteProfileInfo($event->user)) {
            GrantAchievementService::profileInfoCompleted($event->user);
        }
    }
}
