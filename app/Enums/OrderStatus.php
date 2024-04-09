<?php

namespace App\Enums;

enum OrderStatus: int
{
    case NOT_PAID = 1;
    case PAID = 2;
    case CANCELED = 3;

    public function name() : string
    {
        return match($this) {
            self::NOT_PAID => 'در انتظار پرداخت',
            self::PAID => 'موفق',
            self::CANCELED => 'لغو شده'
        };
    }

    public function cssClass() : string
    {
        return match($this) {
            self::NOT_PAID => 'bg-sky-500',
            self::PAID => 'bg-emerald-400',
            self::CANCELED => 'bg-gray-400'
        };
    }

    public function color() : string
    {
        return match($this) {
            self::NOT_PAID => 'primary',
            self::PAID => 'success',
            self::CANCELED => 'light'
        };
    }
}
