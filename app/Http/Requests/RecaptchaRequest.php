<?php

namespace App\Http\Requests;

use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

class RecaptchaRequest extends FormRequest
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
            'recaptcha' => ['required', new Recaptcha()]
        ];
    }

    public function messages() : array
    {
        return [
            'recaptcha.required' => 'لطفا روی دکمه «من ربات نیستم» کلیک کنید'
        ];
    }
}
