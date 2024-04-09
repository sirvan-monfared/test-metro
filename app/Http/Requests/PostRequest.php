<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class PostRequest extends FormRequest
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
            'title' => ['required'],
            'slug' => [
                'required',
                Rule::when($this->routeIs('admin.post.store'), [Rule::unique('posts', 'slug')]),
                Rule::when($this->routeIs('admin.post.update'), [Rule::unique('posts', 'slug')->ignore($this->post)]),
            ],
            'status' => [new Enum(Status::class)]
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?: $this->title)
        ]);
    }
}
