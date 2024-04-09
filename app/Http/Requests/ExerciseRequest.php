<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->alreadyEnrolledIn($this->route('course'));
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:5'],
            'description' => ['required', 'min:5'],
            'link' => ['required_without:filepond_file'],
            'filepond_file' => ['required_without:link'],
            'filepond_all_files' => []
        ];
    }

    public function messages(): array
    {
        return [
            'title' => 'یک عنوان برای تمرین بنویس که بعدا راحت تر بتونی پیداش کنی',
            'description.*' => 'توضیحات بیشتری برای تمرینی که میخوای بفرستی بهم بده تا بتونم بهتر بهت بازخورد بدم',
            'link.*' => 'یا باید یه فایل زیپ برام بفرستی یا اینکه لینک فایل رو برام ارسال کنی',
            'filepond_file.*' => 'یا باید یه فایل زیپ برام بفرستی یا اینکه لینک فایل رو برام ارسال کنی',
        ];
    }
}
