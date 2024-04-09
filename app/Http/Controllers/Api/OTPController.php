<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OTPRequest;
use App\Http\Requests\RecaptchaRequest;
use App\Kodesign\OTP;
use App\Models\User;

class OTPController extends Controller
{
    public function resend(): \Illuminate\Http\Response
    {
        if (!request('identifier') || !emailOrMobile(request('identifier'))) {
            return response([
                'message' => 'امکان اجرای عملیات وجود ندارد',
            ], 401);
        }

        $otp_timer = OTP::send(request('identifier'));

        if (!$otp_timer) {
            return response([
                'message' => 'امکان ارسال کد تایید وجود ندارد',
            ], 401);
        }

        return response([
            'status' => true,
            'timer' => $otp_timer,
        ], 200);
    }

    public function verify(OTPRequest $request, RecaptchaRequest $request2): \Illuminate\Http\Response
    {
        $result = OTP::verify($request->get('identifier'), $request->get('otp'));

        if (!$result->status) {
            return response([
                'message' => 'کد تایید وارد شده صحیح نیست و یا منقضی شده است',
            ], 401);
        }

        if (auth()->check()) {
            auth()->user()->updateVerifiedWith(($request->get('identifier')));
        }

        if (!auth()->check()) {
            $user = $this->createUser($request->get('identifier'), $request->get('otp'));
            auth()->login($user, true);
        }

        return response([
            'status' => true,
            'redirect' => getIntendedUrl(),
        ], 200);
    }

    protected function createUser($username, $otp)
    {
        $type = emailOrMobile($username);
        $email = $phone = $email_verified_at = $phone_verified_at = null;

        if ($type === 'email') {
            $email = enDigits(trim($username));
            $email_verified_at = now();
            $phone = null;
        }

        if ($type === 'mobile') {
            $phone = enDigits(trim($username));
            $phone_verified_at = now();
            $email = null;
        }

        return User::create([
            'email' => $email,
            'phone' => $phone,
            'email_verified_at' => $email_verified_at,
            'phone_verified_at' => $phone_verified_at,
            'password' => bcrypt($otp),
            'is_admin' => false,
            'is_verified' => true,
        ]);
    }
}
