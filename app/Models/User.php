<?php

namespace App\Models;

use App\Enums\Status;
use App\Events\CourseEnrolled;
use App\Notifications\NewTelegramTest;
use App\Notifications\OTPNotification;
use App\Notifications\SuccessfulCourseEnrollment;
use App\Notifications\Telegram\NewestTelegramInFolderTest;
use App\Notifications\Telegram\NewExerciseNotification;
use App\Services\TelegramNotificationService;
use App\Traits\Filterable;
use App\Traits\GiveAdvancedExperience;
use App\Traits\HasFeaturedImage;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use LevelUp\Experience\Concerns\GiveExperience;
use LevelUp\Experience\Concerns\HasAchievements;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Filterable;
    use HasFeaturedImage;
    use GiveExperience, HasAchievements, GiveAdvancedExperience {
        GiveAdvancedExperience::allAchievements insteadof HasAchievements;
        GiveAdvancedExperience::getPoints insteadof GiveExperience;
        GiveAdvancedExperience::addPoints insteadof GiveExperience;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_verified' => 'boolean',
    ];

    protected $appends = ['xp_points', 'avatar'];

    protected string $images_root = 'images/users/';
    protected string $default_image = 'front/images/left-imgs/img-1.svg';

    public static function boot(): void
    {
        parent::boot();

        static::created(function($user) {
            TelegramNotificationService::newUserRegistered($user);
        });
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot(['id', 'status', 'order_id'])
                    ->as('enrollment')
                    ->using(Enrollment::class)
                    ->withTimestamps();
    }

    public function paidCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot(['id', 'status', 'order_id'])
                    ->as('enrollment')
                    ->where('discount_amount', '!=', 0)
                    ->using(Enrollment::class)
                    ->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function activeCourses(): BelongsToMany
    {
        return $this->courses()->wherePivot('status', Status::ACTIVE);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function meta(): HasOne
    {
        return $this->hasOne(UserMeta::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }

    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class)
            ->withPivot('prize', 'prize_title', 'prize_description')
            ->using(Participation::class)
            ->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function hasVerifiedPhone(): bool
    {
        return !is_null($this->phone_verified_at) && !is_null($this->phone);
    }

    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at) && !is_null($this->email);
    }

    public function isVerified(): bool
    {
        return $this->hasVerifiedEmail() || $this->hasVerifiedPhone();
    }

    public function enrollIn(Course $course, array $extra_data = []): bool
    {
        if ($this->alreadyEnrolledIn($course)) {
            return false;
        }

        $this->courses()->attach($course, $extra_data);

        CourseEnrolled::dispatch($course, $this);

        $this->sendEnrollmentNotification($course);

        return true;
    }

    public function alreadyEnrolledIn(Course $course): bool
    {
        return (bool) $this->courses()->find($course);
    }

    public function storeOTP(): int
    {
        $otp = rand(100000, 999999);
        Cache::put([$this->OTPCacheKey() => $otp], now()->addSeconds(60));

        return $otp;
    }

    public function OTPCacheKey(): string
    {
        return "OTP_for_{$this->id}";
    }

    public function recoverOTP()
    {
        return Cache::get($this->OTPCacheKey());
    }

    public function sendOTP(): void
    {
        $this->notify(new OTPNotification($this->storeOTP()));
    }

    public function forgetOTP(): void
    {
        Cache::forget($this->OTPCacheKey());
    }

    public static function byEmailOrMobile($username): self|null
    {
        return User::where('email', $username)
            ->orWhere('phone', $username)
            ->first();
    }

    public function OTPRecipient(): string|bool
    {
        if ($this->is_verified) {
            return false;
        }

        if ($this->phone && !$this->phone_verified_at) {
            return $this->phone;
        }

        if ($this->email && !$this->email_verified_at) {
            return $this->email;
        }

        return false;
    }

    public function updateVerifiedWith($verification_parameter): void
    {
        $type = emailOrMobile($verification_parameter);
        if ($type === 'mobile') {
            $this->verifyMobile();
        }
        if ($type === 'email') {
            $this->verifyEmail();
        }
    }

    protected function verifyMobile():void
    {
        $this->update([
            'phone_verified_at' => now(),
            'is_verified' => 1,
        ]);
    }

    protected function verifyEmail(): void
    {
        auth()->user()->update([
            'email_verified_at' => now(),
            'is_verified' => 1,
        ]);
    }

    public function sendEnrollmentNotification($course): void
    {
        $this->notify(new SuccessfulCourseEnrollment($course));
    }

    public function publicName(): string|null
    {
        if ($this->name) {
            return $this->name;
        }
        if ($this->phone) {
            return $this->phone;
        }
        if ($this->email) {
            return $this->email;
        }

        return null;
    }

    public function updateName(string $name): void
    {
        $this->name = $name;
        $this->save();
    }

    public function totalPayments(): int
    {
        return $this->orders()->paid()->sum('price');
    }

    public function alreadyCommentedOn(Course $course): bool
    {
        return (bool) $course->isUserAlreadyCommented($this->id);
    }

    public function canReviewOnCourse(Course $course): bool
    {
        return $this->alreadyEnrolledIn($course) && ! $this->alreadyCommentedOn($course);
    }

    public function hasApiKey(): bool
    {
        return !! $this->meta?->api_key;
    }

    public function generateApiKey()
    {
        if (! $this->meta) {
            return $this->meta()->create([
               'api_key' => \Str::orderedUuid()
            ]);
        }

        return $this->meta()->update([
            'api_key' => \Str::orderedUuid()
        ]);
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->featuredImage()
        );
    }
}
