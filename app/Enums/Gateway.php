<?php

namespace App\Enums;

enum Gateway : int{
    case Shaba = 1;
    case ZarinPal = 2;
    case PayPing = 3;

    public function name(): string
    {
        return match ($this) {
            self::ZarinPal => 'زرین پال',
            self::Shaba => 'کارت به کارت',
            self::PayPing => 'پی پینگ'
        };
    }

    public function logo(): string
    {
        return match ($this) {
            self::ZarinPal => 'assets/img/gateways/zarinpal.jpg',
            self::Shaba => 'assets/img/gateways/shaba.jpg',
            self::PayPing => 'assets/img/gateways/zarinpal.jpg',
        };
    }
}
