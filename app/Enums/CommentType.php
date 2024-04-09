<?php

namespace App\Enums;

enum CommentType : string
{
    case REVIEW = 'review';
    case COMMENT = 'comment';

    public function hasRating() {
        return match($this) {
            self::REVIEW => true,
            self::COMMENT => false
        };
    }
}
