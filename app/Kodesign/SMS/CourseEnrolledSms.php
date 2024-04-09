<?php

namespace App\Kodesign\SMS;

use App\Models\Course;

class CourseEnrolledSms extends SMS
{
    private Course $course;

    public function __construct(Course $course){
        parent::__construct();

        $this->template(config('sms.templates.course_enrolled'));
        $this->course = $course;
    }

    public function send()
    {
        $params = [
            'token' => $this->course->title
        ];
        return $this->sendSms($params);
    }
}
