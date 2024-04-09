<?php

namespace App\Http\Requests\Admin;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required_without:phone', 'nullable', 'email'],
            'phone' => ['required_without:email', 'nullable', new Phone()],
            'password' => [
                Rule::when($this->routeIs('admin.user.store'), ['required']),
                Rule::when($this->routeIs('admin.user.update'), ['sometimes']),
                'confirmed',
                Password::defaults()
            ]
        ];
    }

    public function prepareForValidation()
    {
        if (! $this->password) {
            $this->request->remove('password');
        }
    }
}
