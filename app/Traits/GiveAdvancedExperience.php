<?php

namespace App\Traits;

use App\Models\User;
use App\Services\Achievement\AchievementService;
use App\Services\Achievement\GrantAchievementService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use LevelUp\Experience\Concerns\GiveExperience;
use LevelUp\Experience\Events\UserLevelledUp;
use LevelUp\Experience\Models\Achievement;
use LevelUp\Experience\Models\Experience;
use LevelUp\Experience\Models\Level;
use Illuminate\Support\Facades\Event;

trait GiveAdvancedExperience
{
    use GiveExperience;

    public function xpPoints(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->experience ? $this->getPoints() : 0
        );
    }

    public function xpHistory(): Collection
    {
        return $this->experienceHistory()->latest('id')->get();
    }

    public function hasAchievement(Achievement $achievement): bool
    {
        return GrantAchievementService::has($this, $achievement);
    }

    public function allAchievements(): BelongsToMany
    {
        return $this->belongsToMany(related: Achievement::class)
            ->withPivot(columns: ['progress', 'completed_at']);
    }

    public function getPoints(): int|null
    {
        return $this->experience?->experience_points;
    }

    public function achievementProgression(Achievement $achievement): int
    {
        $achievement = AchievementService::loadPivotFor($this, $achievement);

        return $achievement?->pivot?->progress ?: 0;
    }

    public function addPoints(int $amount, int $multiplier, string $type, string $reason, string $description, $auditable = null): Experience
    {
        if (config(key: 'level-up.multiplier.enabled') && file_exists(filename: config(key: 'level-up.multiplier.path'))) {
            $amount = $this->getMultipliers(amount: $amount);
        }

        if ($multiplier) {
            $amount *= $multiplier;
        }

        if ($this->experience()->doesntExist()) {
            $level = Level::first();

            $experience = $this->experience()->create(attributes: [
                'level_id' => $level->level,
                'experience_points' => $amount,
            ]);

            $this->fill([
                'level_id' => $experience->level_id,
            ])->save();

            $this->createAudit($amount, $type, $reason, $description, $auditable);

            return $this->experience;
        }

        $this->experience->increment(column: 'experience_points', amount: $amount);

        $this->createAudit($amount, $type, $reason, $description, $auditable);

        return $this->experience;
    }

    protected function createAudit($amount, $type, $reason, $description, $auditable = null): void
    {
        $this->experienceHistory()->create([
            'points' => $amount,
            'type' => $type,
            'reason' => $reason,
            'description' => $description,
            'auditable_type' => $auditable ? get_class($auditable) : null,
            'auditable_id' => $auditable ? $auditable->id : null,
        ]);
    }
}
