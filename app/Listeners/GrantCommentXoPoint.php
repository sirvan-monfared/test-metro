<?php

namespace App\Listeners;

use App\Services\UserPointsService;

class GrantCommentXoPoint
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
        if ($event->comment->isPublished() && ! UserPointsService::alreadyCollectedPointsFor($event->comment, $event->user)) {
            UserPointsService::commentAccepted($event->comment, $event->user);
        }
    }
}
