<?php

namespace App\Kodesign\Cart;

use App\Enums\Status;
use App\Exceptions\CanNotAddToCartException;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

class Cart
{
    public function __construct()
    {
        CartProvider::init();
    }

    public function content(): \Illuminate\Support\Collection
    {
        return CartProvider::content();
    }

    public function getDiscount()
    {
        return CartProvider::discountedPrice();
    }

    /**
     * @throws CanNotAddToCartException
     */
    public function addItem($course): CartItem
    {
        $this->checkCourseAvailability($course);

        return CartProvider::add($course, 1);
    }

    public function removeItem($course)
    {
        CartProvider::remove($this->findItem($course->id)->rowId);
    }

    public function clear(): void
    {
        CartProvider::destroy();
    }

    public function isEmpty(): bool
    {
        return $this->countItems() === 0;
    }

    public function setDiscount(int $discount_percent = 0): void
    {
        CartProvider::setGlobalDiscount($discount_percent);
    }

    public function countItems(): int
    {
        return CartProvider::countItems();
    }

    public function hasItem($id): bool
    {
        return !! $this->findItem($id);
    }

    /**
     * Total Price after applying Tax.
     */
    public function finalPrice(): mixed
    {
        return CartProvider::total();
    }

    /**
     * Returns total price before applying discount and tax.
     */
    public function subTotal(): mixed
    {
        return CartProvider::subtotal();
    }

    protected function findItem($course_id)
    {
        return CartProvider::searchByItemId($course_id);
    }

    public function validateItems(): void
    {
        if (!auth()->check() || cart()->isEmpty()) {
            return;
        }

        $this->checkForAlreadyEnrolledItems();
        $this->checkPriceValidity();
    }

    public function contentToJson(): string
    {
        // throw error if not validated
        $this->validateItems();

        $courses = collect();
        $this->content()->each(fn ($item) => $courses->add($item->toArray()));

        return $courses;
    }

    public function prepareToStore($coupon_data = []): array
    {
        $content = cart()->content()->map(function ($item) {
            return new OrderItem($item->id, $item->name, $item->qty, $item->price);
        })->values();

        // TODO :: change coupon description
        return [
           'subtotal' => $this->subTotal(),
           'total' => $this->finalPrice(),
           'items' => $content,
           'discount' => [
               'total' => cart()->getDiscount(),
               'coupon_code' => data_get($coupon_data, 'code'),
               'coupon_prcent' => data_get($coupon_data, 'percent'),
               'coupon_description' => data_get($coupon_data, 'description'),
           ],
        ];
    }

    private function checkForAlreadyEnrolledItems(): void
    {
        if (!auth()->check() || cart()->isEmpty()) {
            return;
        }

        foreach ($this->content() as $item) {
            if (auth()->user()->alreadyEnrolledIn($item->model)) {
                cart()->removeItem($item->model);
            }
        }
    }

    private function checkPriceValidity(): void
    {
        foreach ($this->content() as $item) {
            $course = Course::find($item->id);
            
            if ($course->finalPrice() !== $item->price) {
                cart()->removeItem($course);
//                cart()->addItem($course);
            }
        }
    }


    /*
    * @throws CanNotAddToCartException
    */
    private function checkCourseAvailability($course)
    {
        if ($course->status !== Status::ACTIVE) {
            return throw new CanNotAddToCartException();
        }

        return true;
    }
}
