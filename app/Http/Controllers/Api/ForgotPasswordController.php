<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OTPRequest;
use App\Http\Requests\RecaptchaRequest;
use App\Kodesign\OTP;
use App\Models\PasswordReset;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function checkUsername(RecaptchaRequest $request): \Illuminate\Http\Response
    {
        $username = request('username');
        $type = emailOrMobile($username);

        if (! in_array($type, ['mobile', 'email'])) {
            return response([
                'message' => 'شماره موبایل یا آدرس ایمیل معتبر نمی باشد'
            ], 401);
        }

        $foundUser = User::byEmailOrMobile($username);

        if (! $foundUser) {
            return response([
                'message' => 'شماره موبایل یا آدرس ایمیل وارد شده در سایت ثبت نشده است'
            ], 401);
        }

        return $this->sendOTPForForgotPassword($username, $type);
    }

    public function verifyOTP(OTPRequest $request, RecaptchaRequest $request2): \Illuminate\Http\Response
    {
        $username = $request->get('identifier');
        $type = emailOrMobile($username);

        $result = OTP::verify($username, $request->get('otp'));

        if (! $result->status) {
            return response([
                'message' => 'کد تایید وارد شده صحیح نیست و یا منقضی شده است'
            ], 401);
        }

        $token = $this->generatePasswordResetToken($type, $username);

        return $this->response(username: $username, type: $type, is_otp: false, data: [
            'redirect' => route('password.reset', $token->token)
        ]);
    }

    protected function sendOTPForForgotPassword($username, bool|string $type): \Illuminate\Http\Response
    {
        $otp = OTP::send($username);
        return $this->response(username: $username, type: $type, is_otp: true, data: ['expires_at' => $otp]);
    }

    /**
     * @param bool|string $type
     * @param mixed $username
     * @return PasswordReset
     */
    protected function generatePasswordResetToken(bool|string $type, mixed $username): PasswordReset
    {
        $user = User::byEmailOrMobile($username);

        return PasswordReset::createFor($user->id);
    }

    protected function response($username, $type, $is_otp, $data = null): \Illuminate\Http\Response
    {
        return response([
            'username' => $username,
            'type' => $type,
            'otp_call' => $is_otp,
            'data' => $data
        ], 200);
    }
}
