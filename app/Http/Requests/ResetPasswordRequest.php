<?php

namespace App\Http\Requests;

use App\Models\PasswordReset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'token' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validateToken()
    {
        $token_record = PasswordReset::findByToken($this->token);

        if (! $token_record?->user) {
            throw ValidationException::withMessages([
                'message' => 'نشست شما منقضی شده است',
            ]);
        }

        return $token_record;
    }

    public function messages()
    {
        return [
            'token.*' => 'نشست شما منقضی شده است',
            'password.required' => 'لطفا رمزعبور را وارد کنید',
            'password.confirmed' => 'فیلدهای رمزعبور وارد شده منطبق نمی باشند',
            'password.min' => 'رمزعبور باید حداقل شامل 8 کاراکتر باشد'
        ];
    }
}
