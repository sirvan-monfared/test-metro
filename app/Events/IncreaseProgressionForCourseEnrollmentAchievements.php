<?php

namespace App\Events;

use App\Services\Achievement\GrantAchievementService;
use App\Services\Achievement\GrantProgressiveAchievementService;
use App\Services\UserPointsService;

class IncreaseProgressionForCourseEnrollmentAchievements
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
    public function handle(CourseEnrolled $event): void
    {
        if ($event->course->isFree()) return;

        GrantProgressiveAchievementService::fourBuy($event->user);

        GrantAchievementService::firstBuy($event->user);
    }
}
