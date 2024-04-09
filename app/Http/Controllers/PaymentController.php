<?php

namespace App\Http\Controllers;

use App\Exceptions\Gateway\CanNotStartException;
use App\Exceptions\Gateway\NotVerifiedException;
use App\Kodesign\Gateway\PayPing;
use App\Kodesign\Gateway\ZarinPal;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use App\Services\TelegramNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    protected mixed $gateway;

    public function __construct() {
        $gateway = config('payment.gateway');
        $class = "App\\Kodesign\\Gateway\\{$gateway}";

        $this->gateway = new $class;
    }

    public function start(Order $order)
    {
        try {
            if ($order->price == 0) {
                return redirect()->away(route('gateway.checkout', $order));
            }

            return redirect()->away($this->gateway->getUrl($order));
        } catch(CanNotStartException) {
            return $this->gatewayDisabled($order);
        }
    }

    public function callback(Request $request): \Illuminate\Contracts\View\View
    {
        try {
            $this->gateway->verify($request);

            $this->enrollToCourses($this->gateway->order()->items(), $this->gateway->order()->id);

            TelegramNotificationService::newPaidOrder($this->gateway->order());

            return view('front.payment.success')->with([
                'order' => $this->gateway->order(),
            ]);
        } catch (NotVerifiedException $e) {

            TelegramNotificationService::newFailedPayment($this->gateway->order());

            return view('front.payment.fail')->with([
                'order' => $this->gateway->order(),
                'gateway_message' => $e->getMessage()
            ]);
        }
    }

    public function checkoutFreeOrder(Order $order): \Illuminate\Http\RedirectResponse
    {
        abort_if(! $order->isFree() || $order->isPaid(), 404);

        Gate::allowIf(fn($user) => $user->id === (int) $order->user_id);

        $this->enrollToCourses($order->items(), $order->id);

        $order->makePaid();

        TelegramNotificationService::newPaidOrder($order);

        return redirect('dashboard')->with([
            'success' => 'ثبت سفارش با موفقیت انجام شد'
        ]);
    }

    public function gatewayDisabled(Order $order)
    {
        TelegramNotificationService::newOrderPlaced($order);

        return view('front.checkout.disabled', [
            'order' => $order
        ]);
    }

    protected function enrollToCourses($items, $order_id): void
    {
        $user = $this->getUser();

        foreach ($items as $item) {
            $user->enrollIn($item->model(), ['order_id' => $order_id]);
        }
    }

    private function getUser(): User
    {
        $user = auth()->user();

        if (! $user) {
            $user = $this->gateway->order()->user;
        }

        return $user;
    }
}
