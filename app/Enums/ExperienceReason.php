<?php

namespace App\Enums;

enum ExperienceReason: string
{
    case COURSE_ENROLLMENT = 'course-enrollment';
    case COMMENT_APPROVE = 'comment-approve';
    case Exercise_REVIEW = 'exercise-review';
    case ACHIEVEMENT = 'achievement';
    case ADMIN_GRANT = 'admin-grant';
    case CAMPAIGN_PRIZE = 'campaign-prize';
}
