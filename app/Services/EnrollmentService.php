<?php

namespace App\Services;

use App\Models\Enrollment;

class EnrollmentService
{
    public static function totalBetween($from, $to): int
    {
        return Enrollment::query()
                ->active()
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->count('id');
    }

    public static function CourseEnrollmentsBetween(int $course_id, $from, $to): int
    {
        return Enrollment::query()
                ->active()
                ->where('course_id', $course_id)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->count('id');
    }
}
