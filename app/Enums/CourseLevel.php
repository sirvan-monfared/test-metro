<?php

namespace App\Enums;

enum CourseLevel: int
{
    case Basic = 1;
    case Intermediate = 2;
    case Advanced = 3;

    public function name() : string
    {
        return match ($this) {
            self::Basic => 'مقدماتی',
            self::Intermediate => 'متوسط',
            self::Advanced => 'پیشرفته'
        };
    }

    public function color() : string
    {
        return match($this) {
            self::Basic => 'green',
            self::Intermediate => 'yellow',
            self::Advanced => 'red',
        };
    }
}
