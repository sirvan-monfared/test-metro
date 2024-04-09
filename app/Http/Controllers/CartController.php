<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Services\BreadCrumbService;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartController extends Controller
{
    public function show()
    {
        $breadCrumbs = BreadCrumbService::cartIndex();

        return view('front.checkout.cart', [
            'breadCrumbs' => $breadCrumbs->items(),
        ]);
    }

    public function checkout(): \Illuminate\Http\RedirectResponse
    {
        $coupon_data = $this->applyCoupon(request()->coupon);

        cart()->validateItems();

        if (cart()->isEmpty()) {
            return redirect()->route('front.home');
        }

        $order = OrderService::storeOrderFromShoppingCart($coupon_data);
        cart()->clear();

        return redirect(route('gateway.start', $order));
    }

    private function applyCoupon($coupon_code) {

        if (! $coupon_code) return false;

        try {
            $coupon = Coupon::findByCode($coupon_code);
            cart()->setDiscount($coupon->percent);

            return [
                'code' => $coupon->code,
                'percent' => $coupon->percent,
                'description' => $coupon->description,
            ];
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}
