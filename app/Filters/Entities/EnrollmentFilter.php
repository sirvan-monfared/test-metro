<?php

namespace App\Filters\Entities;

use App\Filters\Filter;

class EnrollmentFilter extends Filter
{
    protected array $filterables = ['title', 'status', 'course_id', 'user', 'from_date', 'to_date'];

    protected function courseId($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->where('course_id', $value);
    }

    protected function user($value)
    {
        if (!$value) {
            return false;
        }

        $this->builder->whereHas('student', function ($query) use ($value) {
            return $query->where('name', 'LIKE', "%{$value}%")
                        ->orWhere('phone', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
        });
    }
}
