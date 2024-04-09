<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function stats(): \Illuminate\Http\Response
    {
        return response([
            'subtotal' => price_format(cart()->subTotal()),
            'discount' => price_format(cart()->getDiscount()),
            'final_price' => price_format(cart()->finalPrice()),
        ], 200);
    }

    public function applyCoupon()
    {
        request()->validate([
           'coupon_code' => ['required', 'string']
        ]);

        try {
            $coupon = Coupon::findByCode(request('coupon_code'));

        } catch (ModelNotFoundException $e) {
            return response(['error' => 'Coupon not found'], 422);
        }

        cart()->setDiscount($coupon->percent);

        return response([
            'code' => $coupon->code,
            'percent' => $coupon->percent,
            'description' => $coupon->description,
            'discounted_price' => price_format(cart()->getDiscount()),
            'final_price' => price_format(cart()->finalPrice()),
        ], 200);
    }
}
