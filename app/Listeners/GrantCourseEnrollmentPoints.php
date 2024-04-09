<?php

namespace App\Listeners;

use App\Events\CourseEnrolled;
use App\Services\UserPointsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GrantCourseEnrollmentPoints
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
        if (UserPointsService::alreadyCollectedPointsFor($event->course, $event->user)) return;

        UserPointsService::courseEnrolled(
            course: $event->course,
            user: $event->user
        );
    }
}
