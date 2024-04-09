<?php

namespace App\Services;

use App\Enums\Gateway;
use App\Exceptions\AlreadyEnrolledException;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class ManualEnrollmentService
{

    /**
     * @throws AlreadyEnrolledException
     */
    public static function enroll(User $user, Course $course, $price, $description): void
    {
        if ($user->alreadyEnrolledIn($course)) {
            throw new AlreadyEnrolledException();
        };

        $content = self::Ordercontent($course, $price);

        $order = self::createOrder(
            user_id: $user->id,
            price: $price,
            content: serialize($content),
            gateway: Gateway::Shaba,
            description: $description
        );

        $order->makePaid();

        $user->enrollIn($course, ['order_id' => $order->id]);
    }

    protected static function createOrder($user_id, $price, $content, Gateway $gateway, $description = null)
    {
        return Order::create([
            'order_token' => Order::generateOrderToken(),
            'user_id' => $user_id,
            'reference_token' => Order::generateOrderToken(),
            'price' => $price,
            'gateway' => $gateway->value,
            'content' => $content,
            'description' => $description,
        ]);
    }

    protected static function Ordercontent(Course $course, $price)
    {
        return [
            'subtotal' => $price,
            'total' => $price,
            'items' => self::orderItems($course, $price),
            'discount' => [
                'total' => 0,
                'coupon_id' => 'coupon',
                'coupon_description' => 'this is a coupon description',
            ],
        ];
    }

    protected static function orderItems(Course $course, $price)
    {
        return collect([
            new OrderItem($course->id, $course->title, 1, $price),
        ]);
    }
}
