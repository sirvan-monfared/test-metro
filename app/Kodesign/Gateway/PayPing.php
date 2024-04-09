<?php

namespace App\Kodesign\Gateway;

use App\Exceptions\Gateway\CanNotStartException;
use App\Exceptions\Gateway\NotVerifiedException;
use App\Models\Order;
use GuzzleHttp\Promise\PromiseInterface;
use Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Log;

class PayPing extends Gateway
{
    const GET_TOKEN_URL = 'https://api.payping.ir/v2/pay/gotoipg/';
    const PAYMENT_URL = 'https://api.payping.ir/v2/pay';
    const VERIFY_URL = 'https://api.payping.ir/v2/pay/verify';

    public string $order_id;

    public function __construct(){
        $this->gateway_id = \App\Enums\Gateway::PayPing->value;
        $this->merchantId = config('payment.payping.merchant_id');
    }

    /**
     * @throws CanNotStartException
     */
    public function getUrl($order) : string
    {
        if ($this->isPaymentDisabled()) {
            return $this->disabledPaymentUrl($order);
        }

        $response = $this->getPaymentToken(price: $order->price, order_token: $order->order_token);

        if (! $response->ok()) {
            $this->logError('getting PayPing payment url has failed', $response);

            throw new CanNotStartException("مشکلی در اتصال به درگاه پرداخت به وجود آمده است");
        }

        $token = $response->object()->code;
        $this->setReferenceToken($token);
        $this->updateOrderBeforePayment($order);

        return $this->paymentUrl($token);
    }

    /**
     * @throws NotVerifiedException
     */
    public function verify(Request $request)
    {
        $order = $this->findOrder($request);
        $refId = $request->refid;

        if (! $order) {
            throw new NotVerifiedException('مشخصات پرداخت نادرست است');
        }

        $this->setOrder($order);

        $response = $this->verifyPayment(price: $this->order()->price, refId: $refId);

        if (! $response->ok()) {
            $this->updateOrderAfterFailedPayment();

            $this->logError('order verification failed', $response);

            throw new NotVerifiedException(array_values($response->json())[0]);
        }

        $this->setSupportToken($refId);
        $this->updateOrderAfterSuccessfulPayment();

        return $this->supportToken();
    }

    private function findOrder(Request $request): Order|null
    {
        return $this->fetchOrder($request->code);
    }

    private function paymentUrl($token): string
    {
        return self::GET_TOKEN_URL . $token;
    }

    private function getPaymentToken($price, $order_token): PromiseInterface|Response
    {
        return Http::withToken($this->merchantId)
            ->post(self::PAYMENT_URL, [
                "amount" => $price,
                "returnUrl" => route('gateway.callback'),
                "payerIdentity" => auth()->id(),
                "payerName" => auth()->user()->publicName(),
                "description" => '',
                "clientRefId" => $order_token
            ]);
    }

    private function verifyPayment(mixed $price, mixed $refId): PromiseInterface|Response
    {
        return Http::withToken($this->merchantId)
            ->post(self::VERIFY_URL, [
                "amount" => $price,
                "refId" => $refId
            ]);
    }

    private function logError(string $message, $response): void
    {
        Log::debug($message, [
            'status' => $response->status(),
            'body' => $response->json()
        ]);
    }
}
