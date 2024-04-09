<?php

namespace App\Listeners;

use App\Services\UserPointsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GrantPointsForReviewedExercise
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
        if ($event->exercise->isReviewed() && ! UserPointsService::alreadyCollectedPointsFor($event->exercise, $event->user)) {
            UserPointsService::ExerciseReviewed($event->exercise, $event->user);
        }

    }
}
