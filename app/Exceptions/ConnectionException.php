<?php

namespace App\Exceptions;

use Exception;

class ConnectionException extends Exception
{
    public function render(): string
    {
        return 'مشکلی در اجرای کار پیش آمده است ... لطفا مجددا تلاش کنید';
    }
}
