<?php

namespace App\Http\Requests;

use App\Enums\DiscountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CourseRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:3'],
            'slug' => [
                Rule::when($this->routeIs('admin.course.store'), []),
                Rule::when(
                    $this->routeIs('admin.course.update'),
                    ['required', Rule::unique('courses', 'slug')->ignore($this->course)]
                ),
            ],
            'price' => ['required'],
            'description' => ['required'],
            'short_description' => ['required'],
            'status' => ['required', 'numeric'],
            'level' => ['required', 'numeric'],
            'duration' => ['required'],
            'discount_type' => [new Enum(DiscountType::class)],
            'discount_amount' => [
                Rule::when(DiscountType::from($this->discount_type) === DiscountType::NO_DISCOUNT, [], ['required']),
            ],
            'preview_video' => [],
        ];
    }

    protected function prepareForValidation()
    {
        if (DiscountType::from($this->discount_type) === DiscountType::FIXED && (int) $this->discount_amount === 1) {
            $this->merge([
                'discount_amount' => 0,
            ]);
        }
    }
}
