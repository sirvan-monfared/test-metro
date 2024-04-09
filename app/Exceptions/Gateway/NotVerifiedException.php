<?php

namespace App\Exceptions\Gateway;

use Exception;

class NotVerifiedException extends Exception
{
    public function render($message)
    {
        return $message;
    }
}
