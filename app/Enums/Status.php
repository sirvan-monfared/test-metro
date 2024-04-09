<?php

namespace App\Enums;

enum Status : int
{
    case INACTIVE = 1;
    case ACTIVE = 2;
    case SCHEDULED = 3;
    case EXPIRED = 4;

    public function name() : string
    {
        return match ($this) {
            self::INACTIVE => 'غیرفعال',
            self::ACTIVE => 'فعال',
            self::SCHEDULED => 'زمان بندی شده',
            self::EXPIRED => 'منقضی'
        };
    }

    public function color() : string
    {
        return match($this) {
            self::INACTIVE => 'danger',
            self::ACTIVE => 'success',
            self::SCHEDULED => 'primary',
            self::EXPIRED => 'light'
        };
    }
}
