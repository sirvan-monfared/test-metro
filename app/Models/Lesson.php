<?php

namespace App\Models;

use App\Enums\FileType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $casts = [
        'is_free' => 'boolean',
        'status' => Status::class
    ];

    public function sections() : BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function files() : HasMany
    {
        return $this->hasMany(LessonFile::class);
    }

    public function videos() : HasMany
    {
        return $this->files()->where('type', FileType::VIDEO);
    }

    public function documents() : HasMany
    {
        return $this->files()->where('type', FileType::PDF);
    }

    public function archives() : HasMany
    {
        return $this->files()->where('type', FileType::ZIP);
    }

    public function links() : HasMany
    {
        return $this->files()->where('type', FileType::LINK);
    }

    public function section()
    {
        return $this->sections()?->first();
    }

    public function isFree()
    {
        return $this->is_free;
    }

    public function isPreview(): bool
    {
        return (! $this->course->isFree() && $this->isFree());
    }
}
