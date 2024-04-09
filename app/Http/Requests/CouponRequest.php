<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'min:3',
                Rule::when($this->routeIs('admin.coupon.store'), Rule::unique('coupons', 'code')),
                Rule::when($this->routeIs('admin.coupon.update'),  [Rule::unique('coupons', 'code')->ignore($this->coupon)]),
            ],
           'percent' => ['required', 'int', 'between:1,99'],
           'description' => ['required', 'min:3'],
           'status' => Rule::enum(Status::class),
           'expires_at' => ['nullable'],
           'no_expiration' => []
        ];
    }
}
