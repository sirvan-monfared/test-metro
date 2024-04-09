<?php

namespace App\Kodesign;
use App\Kodesign\SMS\OTPSms;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Seshac\Otp\Otp as OTPBuilder;

class OTP
{
    public static function generate($identifier)
    {
        return OTPBuilder::setValidity(2)
            ->setLength(6)
            ->setMaximumOtpsAllowed(10)
            ->generate($identifier);
    }

    public static function send($to)
    {
        $type = emailOrMobile($to);

        if ($expires_at = self::expiresAt($to)) {
            return $expires_at;
        }

        $otp = self::generate($to);

        if (! $otp->status) return false;

        if ($type === 'email') {
            Mail::to($to)->send(new OTPMail($otp->token));
        }

        if ($type === 'mobile') {
            (new OTPSms($otp->token))->to($to)->send();
        }

        return self::expiresAt($to);
    }

    public static function verify($identifier, $otp_token)
    {
        return OTPBuilder::validate($identifier, $otp_token);
    }

    public static function expiresAt($to): bool|int
    {
        $expires = OTPBuilder::expiredAt($to);

        if (! $expires->status || $expires->expired_at->isPast()) return false;

        return $expires ? $expires->expired_at->diffInSeconds(now()) * 1000 : false;
    }
}
