<?php

namespace App\Http\Requests;

use App\Enums\CommentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CommentRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                Rule::when(! auth()->user()->name, ['required', 'min: 3']),
            ],
            'rating' => [
                Rule::when($this->type === 'review', ['required'])
            ],
            'body' => ['required', 'min: 5'],
            'parent_id' => ['sometimes', 'integer'],
            'type' => new Enum(CommentType::class)
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'لطفا نام خود را وارد کنید',
            'name.min' => 'نام شما حداقل باید شامل 3 حرف باشد',
            'body.required' => 'چند کلمه از تجربه ات در مورد این دوره برامون بنویس',
            'body.min' => 'یک مقدار بیشتر از تجربه ات بنویس. حیفه!',
            'rating.required' => 'لطفا بگو به این دوره چند امتیاز میدی. 5 ستاره یعنی عالی!',
        ];
    }
}
