<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMeta extends Model
{
    use HasFactory;

    public $table = 'users_meta';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
