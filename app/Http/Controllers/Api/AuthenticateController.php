<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ConnectionException;
use App\Facades\DisposableEmailChecker;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RecaptchaRequest;
use App\Kodesign\OTP;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function checkUsername(RecaptchaRequest $request): Response
    {
        try {
            $username = trim(request('username'));
            $type = emailOrMobile($username);

            if (!in_array($type, ['mobile', 'email'])) {
                return $this->badRequestResponse();
            }

            if (isEmail($username) && !DisposableEmailChecker::check($username)) {
                return $this->badRequestResponse();
            }

            $foundUser = User::byEmailOrMobile($username);

            if (!$foundUser) {
                return $this->sendOTPForRegister($username, $type);
            }

            return $this->loginResponse($foundUser, $type);

        } catch (ConnectionException $e) {
            return response([
                'message' => $e->getMessage()
            ], 401);
        }

    }

    public function login(LoginRequest $request): Response
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            $user = auth()->user();
            $type = emailOrMobile(request('email'));

            if ($user->is_verified) {
                $intended_url = session()->get('url.intended', url('dashboard'));
                session()->forget('url.intended');

                return $this->response(username: $user->username, type: $type, is_otp: false, data: [
                    'redirect' => $intended_url
                ]);
            }

            return $this->response(username: $user->username, type: $type, is_otp: true);
        } catch (ValidationException $e) {
            return response([
                'message' => 'نام کاربری و رمز عبور وارد شده صحیح نیست'
            ], 401);
        }
    }

    public function response($username, $type, $is_otp, $data = null): Response
    {
        return response([
            'username' => $username,
            'type' => $type,
            'otp_call' => $is_otp,
            'data' => $data
        ], 200);
    }

    protected function sendOTPForRegister($username, bool|string $type): Response
    {
        $otp = OTP::send($username);
        return $this->response(username: $username, type: $type, is_otp: true, data: ['expires_at' => $otp]);
    }

    protected function loginResponse($foundUser, bool|string $type): Response
    {
        return $this->response(username: $foundUser, type: $type, is_otp: false);
    }

    protected function badRequestResponse(): Response
    {
        return response([
            'message' => 'شماره موبایل یا آدرس ایمیل معتبر نمی باشد'
        ], 401);
    }
}
