<?php

namespace App\Enums;

enum ExerciseStatus: int
{
    case UNSEEN = 1;
    case REVIEWED = 2;
    case WATCHING = 3;

    public function name() : string
    {
        return match($this) {
            self::UNSEEN => 'بازبینی نشده',
            self::REVIEWED => 'بازبینی شده',
            self::WATCHING => 'در حال بررسی',
        };
    }

    public function cssClass() : string
    {
        return match($this) {
            self::UNSEEN => 'bg-gray-500',
            self::REVIEWED => 'bg-emerald-400',
            self::WATCHING => 'bg-sky-400'
        };
    }

    public function color() : string
    {
        return match($this) {
            self::UNSEEN => 'danger',
            self::REVIEWED => 'success',
            self::WATCHING => 'primary',
        };
    }
}
