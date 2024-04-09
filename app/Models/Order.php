<?php

namespace App\Models;

use App\Enums\Gateway;
use App\Enums\OrderStatus;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

class Order extends Model
{
    use HasFactory;
    use Filterable;

    protected $casts = [
        'status' => OrderStatus::class,
        'gateway' => Gateway::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function enrollment(): Enrollment
    {
        return Enrollment::where('order_id', $this->id)->first();
    }

    public function scopeNotPaid($query)
    {
        return $query->where('status', '!=', OrderStatus::PAID);
    }

    public function scopePaid($query)
    {
        return $query->where('status', '=', OrderStatus::PAID);
    }

    public function scopeNotFree($query)
    {
        return $query->where('price', '>', 0);
    }

    public function content(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (object) unserialize($value)
        );
    }

    public function items()
    {
        return $this->content->items;
    }

    public function totalPrice()
    {
        return $this->content->total;
    }

    public function subtotal()
    {
        return $this->content->subtotal;
    }

    public function totalDiscount()
    {
        return Arr::get($this->content->discount, 'total');
    }

    public function hasDiscount(): bool
    {
        return $this->totalDiscount() > 0;
    }

    public function discount(): array
    {
        return $this->hasDiscount() ? $this->content?->discount : [];
    }

    public static function generateOrderToken(): string
    {
        return uniqid().time();
    }

    public function makePaid(): static
    {
        $this->status = OrderStatus::PAID;
        $this->save();

        return $this;
    }

    public function isFree(): bool
    {
        $cumulative_sum = $this->content->items->map(fn ($item) => $item->price())->sum();

        return $this->price == 0 && $this->content->total == 0 && $cumulative_sum == 0;
    }

    public function isPaid(): bool
    {
        return $this->status === OrderStatus::PAID;
    }

    public static function forUser($user_id)
    {
        // dd(Order::where('user_id', $user_id)->notFree()->get());
        return Order::where('user_id', $user_id)->paid()->notFree()->get();
    }
}
