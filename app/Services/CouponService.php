<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponService
{
    public static function create(Request $request): Coupon
    {
        return Coupon::create([
            'code' => $request->code,
            'percent' => $request->percent,
            'description' => $request->description,
            'expires_at' => self::getExpirationDate($request),
            'status' => $request->status
        ]);
    }

    public static function update(Coupon $coupon, Request $request): Coupon
    {
        $coupon->update([
            'code' => $request->code,
            'percent' => $request->percent,
            'description' => $request->description,
            'expires_at' => self::getExpirationDate($request),
            'status' => $request->status
        ]);

        return $coupon;
    }

    /**
     * @param Request $request
     * @return string|null
     */
    public static function getExpirationDate(Request $request): ?string
    {
        return ($request->expires_at && !$request->has('no_expiration')) ? endOfJalaliDay(date: $request->expires_at) : null;
    }
}
