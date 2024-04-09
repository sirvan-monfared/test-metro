<?php

namespace App\Exceptions\Gateway;

use Exception;

class CanNotStartException extends Exception
{
    public function render($error_message = '') : string
    {
        return $error_message ?: 'مشکلی در اتصال به درگاه پرداخت به وجود آمده است';
    }
}
