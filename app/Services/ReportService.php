<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class ReportService
{
    protected string $_range;
    protected Carbon $_from;
    protected Carbon $_to;

    public function __construct()
    {

    }

    protected function setDates(): static
    {
        if ($this->_range === 'DAILY') {
            $this->_from = now()->startOfDay();
            $this->_to = now();
        }

        if ($this->_range === 'WEEKLY') {
            $this->_from = now()->startOfWeek();
            $this->_to = now();
        }

        if ($this->_range === 'MONTHLY') {
            $this->_from = now()->startOfMonth();
            $this->_to = now();
        }

        return $this;
    }

    public function daily(): static
    {
        $this->_range = 'DAILY';
        return $this->setDates();
    }

    public function weekly(): static
    {
        $this->_range = 'WEEKLY';
        return $this->setDates();
    }

    public function monthly(): static
    {
        $this->_range = 'MONTHLY';
        return $this->setDates();
    }

    public function report(): object
    {
        return (object) [
            'data' => (object) [
                'users_registered' => $this->usersRegistered(),
                'total_income' => $this->income(),
                'total_enrollments' => $this->enrollments(),
                'course_enrollments' => $this->courseEnrollments(),
                'total_comments' => $this->comments(),
                'total_exercises' => $this->exercises(),
                'failed_orders' => $this->failedOrders(),
                'total_user_points' => $this->points()
            ],
            'stats' => $this->_range,
            'type' => $this->type(),
            'from' => $this->_from->format('Y/m/d'),
            'to' => $this->_to->format('Y/m/d'),
            'from_jalali' => $this->_from->toJalali()->format('Y/m/d'),
            'to_jalali' => $this->_to->toJalali()->format('Y/m/d'),
            'generated_on' => now()->toJalali()->format('Y/m/d ساعت H و i دقیقه و s ثانیه')
        ];
    }

    private function type(): string
    {
        return match($this->_range) {
            'DAILY' => 'روزانه',
            'WEEKLY' => 'هفتگی',
            'MONTHLY' => 'ماهانه',
        };
    }

    private function usersRegistered(): int
    {
        return UserService::totalRegisterCount($this->_from, $this->_to);
    }

    private function income(): int
    {
        return OrderService::totalIncome($this->_from, $this->_to);
    }

    private function enrollments(): int
    {
        return EnrollmentService::totalBetween($this->_from, $this->_to);
    }

    private function courseEnrollments(): object
    {
        $courses = Course::list()->get();
        $output = [];

        foreach ($courses as $course) {
            $output[$course->title] = EnrollmentService::CourseEnrollmentsBetween($course->id, $this->_from, $this->_to);
        }

        return (object) $output;
    }

    private function comments(): int
    {
        return CommentService::totalBetween($this->_from, $this->_to);
    }

    private function exercises(): int
    {
        return ExerciseService::totalBetween($this->_from, $this->_to);
    }

    private function failedOrders()
    {
        return OrderService::failedOrdersBetween($this->_from, $this->_to);
    }

    private function points()
    {
        return UserPointsService::totalPointsGatheredBetween($this->_from, $this->_to);
    }

}
