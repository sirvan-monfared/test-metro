<?php

namespace App\Exceptions;

use Exception;

class CanNotAddToCartException extends Exception
{
    public function render()
    {
        return 'امکان اضافه کردن آیتم به سبد خرید وجود ندارد';
    }
}
