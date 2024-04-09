<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Coupon extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => Status::class,
        'expires_at' => 'datetime'
    ];

    public function scopeNotExpired($query)
    {
        return $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function scopeAvailable($query)
    {
        return $query->active()->notExpired();
    }

    public function isExpirable(): bool
    {
        return !! $this->expires_at;
    }

    public function hasExpired(): bool
    {
        return $this->isExpirable() && now()->greaterThan($this->expires_at);
    }

    public function status()
    {
        if ($this->hasExpired()) {
            return Status::EXPIRED;
        }

        return $this->status;
    }

    public static function generate(string $code, int $discount_percent, $expires_at = null)
    {
        return Coupon::create([
            'code' => $code,
            'percent' => $discount_percent,
            'expires_at' => $expires_at,
            'status' => Status::ACTIVE
        ]);
    }

    public static function findByCode(string $code)
    {
        $coupon = Coupon::where('code', $code)->available()->first();

        if (! $coupon) {
            throw new ModelNotFoundException();
        }

        return $coupon;
    }
}
