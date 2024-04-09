<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5'],
            'telegram_id' => ['required', 'min:4'],
            'education' => ['required', Rule::in(array_keys(educationOptions()))],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', Rule::in(['male', 'female'])]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'لطفا نام خود را وارد کنید',
            'name.min' => 'نام و نام خانوادگی باید حداقل سه کاراکتر باشد',
            'telegram_id.*' => 'لطفا یک آیدی یا شماره تلگرام معتبر وارد نمایید ',
            'birth_date.*' => 'لطفا یک تاریخ تولد معتبر وارد نمایید',
            'gender.*' => 'انتخاب جنسیت اجباری است'
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
           'birth_date' => verta()->parse($this->birth_date)->format('Y/m/d')
        ]);
    }
}
