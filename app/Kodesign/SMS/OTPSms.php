<?php

namespace App\Kodesign\SMS;

class OTPSms extends SMS
{
    private mixed $otp;

    public function __construct($otp){
        parent::__construct();

        $this->template(config('sms.templates.otp'));
        $this->otp = $otp;
    }

    public function send()
    {
        $params = [
            'token' => $this->otp
        ];

        return $this->sendSms($params);
    }
}
