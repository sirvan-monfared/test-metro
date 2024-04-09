<?php

namespace App\Providers;

use App\Events\CommentStatusChanged;
use App\Events\ExerciseReviewed;
use App\Events\ProfileUpdated;
use App\Events\CourseEnrolled;
use App\Events\IncreaseProgressionForCourseEnrollmentAchievements;
use App\Listeners\GrantAchievementIfProgressionFinished;
use App\Listeners\GrantAchievementXpToUser;
use App\Listeners\GrantCommentXoPoint;
use App\Listeners\GrantCourseEnrollmentPoints;
use App\Listeners\GrantPointsForReviewedExercise;
use App\Listeners\LockAchievementProgression;
use App\Listeners\GrantProfileAchievements;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use LevelUp\Experience\Events\AchievementAwarded;
use LevelUp\Experience\Events\AchievementProgressionIncreased;
use LevelUp\Experience\Models\ExperienceAudit;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CourseEnrolled::class => [
            IncreaseProgressionForCourseEnrollmentAchievements::class,
            GrantCourseEnrollmentPoints::class
        ],
        AchievementAwarded::class => [
            GrantAchievementXpToUser::class,
            LockAchievementProgression::class
        ],
        AchievementProgressionIncreased::class => [
            GrantAchievementIfProgressionFinished::class
        ],
        CommentStatusChanged::class => [
            GrantCommentXoPoint::class
        ],
        ProfileUpdated::class => [
            GrantProfileAchievements::class
        ],
        ExerciseReviewed::class => [
            GrantPointsForReviewedExercise::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
