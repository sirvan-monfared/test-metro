<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PasswordReset extends Model
{
    const EXPIRE_IN = 4;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('created_at', '>=', now()->subMinutes(self::EXPIRE_IN));
    }

    public static function createFor($user_id)
    {
        return static::create([
            'user_id' => $user_id,
            'token' => self::createNewToken()
        ]);
    }

    public static function findByToken($token)
    {
        return static::where('token', $token)->active()->latest()->first();
    }

    public static function createNewToken(): bool|string
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }
}
