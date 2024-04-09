<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class DisposableEmailChecker extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'DisposableEmailChecker';
    }
}
