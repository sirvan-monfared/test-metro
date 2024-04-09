<?php

namespace App\Support;

use App\Exceptions\ConnectionException;
use Illuminate\Http\Client\Response;
use Mockery\Exception;

class DisposableEmailChecker
{
    protected Response $response;

    /**
     * @throws ConnectionException
     */
    public function check(string $email): bool
    {
        try {
            $this->response = \Http::get("https://www.validator.pizza/email/$email");

            return $this->passed();
        } catch (Exception) {
            throw new ConnectionException();
        }
    }

    public function passed(): bool
    {
        return $this->response?->ok() && $this->response['mx'] && ! $this->response['disposable'];
    }
}
