<?php

namespace App\Services;

use App\Enums\ExperienceReason;
use App\Models\Campaign;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use LevelUp\Experience\Enums\AuditType;
use LevelUp\Experience\Models\Achievement;
use LevelUp\Experience\Models\Experience;

class UserPointsService
{
    public static function addPoints(User $user, int $points, string $reason, string $description, mixed $auditable = null): Experience|false
    {
        if (! $points) return false;

        return $user->addPoints(
            amount: $points,
            multiplier: static::getMultiplier(),
            type: AuditType::Add->value,
            reason: $reason,
            description: $description,
            auditable: $auditable
        );
    }

    public static function courseEnrolled(Course $course, User $user): Experience|false
    {
        return static::addPoints(
            user: $user,
            points: $course->exp_points,
            reason: ExperienceReason::COURSE_ENROLLMENT->value,
            description: "خرید دوره {$course->title}",
            auditable: $course
        );
    }

    public static function commentAccepted(Comment $comment, User $user): Experience|false
    {
        return static::addPoints(
            user: $user,
            points: 20,
            reason: ExperienceReason::COMMENT_APPROVE->value,
            description: "تایید دیدگاه در {$comment->commentableFullName()}",
            auditable: $comment
        );
    }

     public static function ExerciseReviewed(Exercise $exercise, User $user): Experience|false
    {
        return static::addPoints(
            user: $user,
            points: $exercise->rating * 2,
            reason: ExperienceReason::Exercise_REVIEW->value,
            description: " امتیاز دهی برای تمرین {$exercise->title} در دوره {$exercise->course->title} ",
            auditable: $exercise
        );
    }

    public static function achievementReached(Achievement $achievement, User $user): void
    {
        static::addPoints(
            user: $user,
            points: $achievement->xp_points,
            reason: ExperienceReason::ACHIEVEMENT->value,
            description: " دریافت نشان افتخار {$achievement->description}",
            auditable: $achievement
        );

    }

    public static function campaignPrize(Campaign $campaign, User $user, $points): void
    {
        static::addPoints(
            user: $user,
            points: $points,
            reason: ExperienceReason::CAMPAIGN_PRIZE->value,
            description: "جایزه شرکت در {$campaign->title}",
            auditable: $campaign
        );
    }

    public static function alreadyCollectedPointsFor(mixed $model, User $user): bool
    {
        return !! $user->experienceHistory()
                    ->where('auditable_type', get_class($model))
                    ->where('auditable_id', $model->id)
                    ->count();
    }

    public static function loadPivotFor(User $user, Experience $experience)
    {

    }

    public static function totalPointsGatheredBetween($from, $to)
    {
        return DB::table('experience_audits')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->sum('points');
    }

    protected static function getMultiplier()
    {
        return config('level-up.global_multiplier');
    }


}
