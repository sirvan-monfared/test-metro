<?php

namespace App\Http\Controllers;

use App\Exceptions\CanNotAddToCartException;
use App\Models\Course;

class CartItemController extends Controller
{
    public function add(Course $course)
    {
        try {
            cart()->addItem($course);

            return response([
                'cart_count' => cart()->countItems(),
            ], 200);
        } catch (CanNotAddToCartException $e) {
            return response([
                'messsage' => 'امکان اضافه کردن آیتم در سبد خرید وجود ندارد',
            ], 400);
        }
    }

    public function remove(Course $course)
    {
        cart()->removeItem($course);

        if (request()->wantsJson()) {
            return response([
                'cart_count' => cart()->countItems(),
            ], 200);
        }

        return redirect()->back()->with('success', 'item removed from card successfully');
    }
}
