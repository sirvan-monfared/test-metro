<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campaign extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('prize', 'prize_title', 'prize_description')
            ->using(Participation::class)
            ->withTimestamps();
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }

    public function userAttendance(User $user)
    {
        $record = $this->users()->where('user_id', $user->id)->first();

        return $record ? $record->pivot : null;
    }

    public function alreadyFinishedForUser(User $user): bool
    {
        return !! $this->userAttendance($user);
    }
}
