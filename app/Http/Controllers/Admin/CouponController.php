<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    public function index()
    {
        return view('admin.coupon.index', [
            'coupons' => Coupon::latest('id')->paginate(20)
        ]);
    }

    public function create()
    {
        $coupon = (new Coupon())->fill(['status' => Status::ACTIVE]);

        return view('admin.view.create', [
            'coupon' => $coupon
        ]);
    }

    public function store(CouponRequest $request)
    {
        $coupon = CouponService::create($request);

        return redirect()->route('admin.coupon.edit', $coupon)->withSuccess('ویرایش با موفقیت انجام شد');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', [
            'coupon' => $coupon
        ]);
    }

    public function update(Coupon $coupon, CouponRequest $request)
    {
        CouponService::update($coupon, $request);

        return redirect()->back()->withSuccess('ویرایش با موفقیت انجام شد');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        session()->flash('success', 'عملیات حذف با موفقیت انجام شد');
        return response('', 200);
    }
}
