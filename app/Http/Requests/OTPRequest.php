<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OTPRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'otp' => ['required', 'min: 6', 'max: 6'],
            'identifier' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'identifier.*' => 'شماره موبایل یا رمزعبور ارسال شده معتبر نیست',
            'otp.*' => 'کد تایید وارد شده معتبر نیست'
        ];
    }
}
