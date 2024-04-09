<?php

namespace App\Kodesign\SMS;

use Kavenegar;

class SMS
{
    protected string $template_id;
    protected string|int $to;
    protected string|int $from;

    public function __construct()
    {
        $this->from = config('sms.from');
    }

    public function to($to): static
    {
        $this->to = convertDigitsToLatin($to);

        return $this;
    }

    public function template($template_id): static
    {
        $this->template_id = $template_id;

        return $this;
    }

    public function sendSms($pattern_values)
    {
        try {
            return Kavenegar::VerifyLookup(
                $this->to,
                $this->getTokenValue(data_get($pattern_values, 'token')),
                $this->getTokenValue(data_get($pattern_values, 'token1')),
                $this->getTokenValue(data_get($pattern_values, 'token2')),
                $this->template_id,
                null
            );
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            return false;
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            return false;
        }
    }

    protected function getTokenValue($token)
    {
        if (! $token) return null;
        
        return str_replace(' ', '-', $token);
    }
}
