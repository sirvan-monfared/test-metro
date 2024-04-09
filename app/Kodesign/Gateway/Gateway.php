<?php

namespace App\Kodesign\Gateway;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class Gateway
{
    protected int $gateway_id;

    protected string $reference_token;

    protected string $support_token;

    protected Order $order;

    protected string $merchantId;

    public function getUrl(Order $order){}

    public function verify(Request $request){}

    public function isPaymentDisabled(): bool
    {
        return config('payment.disabled', false);
    }

    public function disabledPaymentUrl(Order $order): string
    {
        return route('gateway.disabled', $order);
    }

    public function updateOrderBeforePayment($order){
        $order->update([
            'reference_token' => $this->referenceToken(),
            'gateway' => $this->gateway_id,
        ]);
    }

    public function updateOrderAfterSuccessfulPayment(){
        $this->order()->update([
            'support_token' => $this->supportToken(),
            'status' => OrderStatus::PAID,
        ]);
    }

    public function updateOrderAfterFailedPayment(){
        $this->order()->update([
            'support_token' => null,
            'status' => OrderStatus::CANCELED,
        ]);
    }

    public function getOrder(){}

    protected function translateError($error_code){}

    protected function generateOrderId(): string
    {
        if ($this->order_id) return $this->order_id;

        $this->order_id = uniqid() . time();
        return $this->order_id;
    }

    public function referenceToken(): string
    {
        return $this->reference_token;
    }

    public function supportToken() : string
    {
        return $this->support_token;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function setReferenceToken($reference_token): void
    {
        $this->reference_token = $reference_token;
    }

    public function setSupportToken($support_token): void
    {
        $this->support_token = $support_token;
    }

    protected function fetchOrder($reference_token): Order|null
    {
        return Order::where('reference_token', $reference_token)
            ->notPaid()
            ->first();
    }

}
