<?php

namespace App\Enums;

enum CommentStatus : int 
{
    case INACTIVE = 1;
    case ACTIVE = 2;
    case SPAM = 3;


    public function name() : string 
    {
        return match($this) {
            self::INACTIVE => 'در انتظار تایید',
            self::ACTIVE => 'فعال',
            self::SPAM => 'هرزنامه'
        };
    }

    public function color() : string
    {
        return match($this) {
            self::INACTIVE => 'warning',
            self::ACTIVE => 'success',
            self::SPAM => 'danger'
        };
    }

    public function lists() : array
    {
        return [
            self::INACTIVE => 'در انتظار تایید',
            self::ACTIVE => 'فعال',
            self::SPAM => 'هرزنامه'
        ];
    }

}