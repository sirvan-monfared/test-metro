<?php

namespace App\Enums;

enum FileType: int
{
    case VIDEO = 1;
    case ZIP = 2;
    case PDF = 3;
    case LINK = 4;

    public function names() : string
    {
        return match($this) {
            self::VIDEO => 'ویدئو',
            self::ZIP => 'Zip',
            self::PDF => 'Pdf',
            self::LINK => 'لینک'
        };
    }
}
