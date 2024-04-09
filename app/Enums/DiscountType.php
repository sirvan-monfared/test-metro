<?php

namespace App\Enums;


enum DiscountType: int
{
    case NO_DISCOUNT = 1;
    case PERCENTAGE = 2;
    case FIXED = 3;

    public function name() : string
    {
        return match($this) {
            self::NO_DISCOUNT => 'بدون تخفیف',
            self::PERCENTAGE => 'درصد تخفیف',
            self::FIXED => 'تخفیف ثابت',
        };
    }

    public function calculate($price, $discount_amount): float|int
    {
        return match($this) {
            self::NO_DISCOUNT => $price,
            self::PERCENTAGE => floor($price - ($discount_amount / 100) * $price),
            self::FIXED => $discount_amount,
        };
    }

}
