<?php

namespace App\Exceptions;

use Exception;

class TooManyCommentsException extends Exception
{
    public function message()
    {
        return 'یه خورده آروم تر ... خیلی سریع داری تایپ میکنی!';
    }
}
