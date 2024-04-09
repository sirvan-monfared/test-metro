<?php

namespace App\Models;

use App\Enums\ExerciseStatus;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Exercise extends Model
{
    use HasFactory;
    use Filterable;

    protected $casts = [
        'status' => ExerciseStatus::class,
        'public' => 'boolean'
    ];

    public function files(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isReviewed(): bool
    {
        return $this->status === ExerciseStatus::REVIEWED && ! empty($this->review);
    }
}
