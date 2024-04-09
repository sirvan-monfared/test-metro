<?php
namespace App\Kodesign\Cart;

use App\Models\Course;
use Illuminate\Support\Collection;

class CartProvider {
    private static Collection $items;
    private static int $discount;
    private static string $instance;

    public static function init(): void
    {
        static::$instance = config('cart.session_name');
        static::$items = self::content();
        static::$discount = 0;
    }

    public static function content(): Collection
    {
        if (is_null(session(self::$instance))) {
            return new Collection();
        }

        return session(self::$instance);
    }

    public static function add(Course $course, $quantity): CartItem
    {
        $cartItem =  new CartItem(
            id: $course->id,
            name: $course->title,
            price: $course->finalPrice(),
            model: $course,
            qty: $quantity,
        );

        static::$items->add($cartItem);

        static::updateSession();
        return $cartItem;
    }

    public static function remove($rowId): void
    {

        static::$items = static::$items->reject(function($item) use($rowId) {
            return $item->rowId === $rowId;
        });

        static::updateSession();
    }

    public static function destroy(): void
    {
        static::$items = new Collection();
        static::clearSession();
    }

    public static function countItems(): int
    {
        return static::content()->count();
    }

    public static function setGlobalDiscount($percent): void
    {
        static::$discount = $percent;
        static::updateSession();
    }

    public static function searchByItemId($itemId): CartItem|null
    {
        return static::content()->where('id', $itemId)->first();
    }

    // returns the actual discounted price, not the totalPrice after discount!
    public static function discountedPrice(): int
    {
        return static::subtotal() * (static::$discount / 100);
    }

    // total price (without discount)
    public static function subtotal(): int
    {
        return static::content()->sum(function($item) {
            return $item->price * $item->qty;
        });
    }

    // total price (with applied discount)
    public static function total(): int
    {
        return static::subtotal() - static::discountedPrice();
    }

    public static function store()
    {

    }

    private static function updateSession(): void
    {
        session()->put(self::$instance, self::$items);
    }

    private static function clearSession(): void
    {
        session()->put(self::$instance, null);
    }
}
