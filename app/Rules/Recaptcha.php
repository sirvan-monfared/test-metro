<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify",[
            'secret' => config('recaptcha.secret_key'),
            'response' => $value
        ]);

        return $response->json()["success"];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'شما توسط سایت به عنوان ربات شناسایی شدید';
    }
}
