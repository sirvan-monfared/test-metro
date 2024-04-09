<?php

namespace App\Http\Controllers;

use App\Kodesign\OTP;

class VerifyOTPController extends Controller
{

    public function index(): \Illuminate\Contracts\View\View
    {
        abort_if(auth()->user()->is_verified, 403);

        $otp_recipient = auth()->user()->OTPRecipient();

        abort_if(! $otp_recipient, 403);

        $expires_at = OTP::send($otp_recipient);

        return view('auth-new.otp')->with([
            'resend_timer' => $expires_at,
            'recipient' => $otp_recipient,
            'recipient_type' => emailOrMobile($otp_recipient)
        ]);
    }
}
