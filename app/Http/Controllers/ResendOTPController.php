<?php

namespace App\Http\Controllers;


class ResendOTPController extends Controller
{
    public function resend(): \Illuminate\Http\RedirectResponse
    {
        auth()->user()->sendOTP();

        return back()->with('success', 'OTP Resent Successfully');
    }
}
