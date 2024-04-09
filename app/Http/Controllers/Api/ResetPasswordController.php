<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function reset(ResetPasswordRequest $request)
    {
        $token_record = $request->validateToken();

        $token_record->user->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        auth()->login($token_record->user);
        $token_record->delete();

        return response([
            'status' => true,
            'data' => [
                'redirect' => session()->get('url.intended', route('dashboard'))
            ]
        ], 200);
    }
}
