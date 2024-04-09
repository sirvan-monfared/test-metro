<?php

namespace App\Kodesign\Gateway;

use App\Models\Order;
use App\Exceptions\Gateway\CanNotStartException;
use App\Exceptions\Gateway\NotVerifiedException;
use Illuminate\Http\Request;

class ZarinPal extends Gateway
{
    public string $order_id;

    public function __construct(){
        $this->gateway_id = \App\Enums\Gateway::ZarinPal->value;
        $this->merchantId = config('payment.zarinpal.merchant_id');
    }

    /**
     * @throws CanNotStartException
     */
    public function getUrl($order) : string
    {
        if ($this->isPaymentDisabled()) {
            return $this->disabledPaymentUrl($order);
        }

        $response = zarinpal()
            ->amount($order->price)
            ->request()
            ->description('a new payment')
            ->callbackUrl(route('gateway.callback'))
            ->send();


        if (! $response->success()) {
            \Log::debug($response->error()->message());
            throw new CanNotStartException($response->error()->message());
        }

        $this->setReferenceToken($response->authority());
        $this->updateOrderBeforePayment($order);

        return $response->url();
    }

    /**
     * @throws NotVerifiedException
     */
    public function verify(Request $request)
    {
        $order = $this->findOrder($request);

        if (! $order) {
            throw new NotVerifiedException('مشخصات پرداخت نادرست است');
        }

        $this->setOrder($order);

        $response = zarinpal()
            ->amount($this->order()->price)
            ->verification()
            ->authority($request->get('Authority'))
            ->send();

        if (! $response->success()) {
            $this->updateOrderAfterFailedPayment();
            throw new NotVerifiedException($response->error()->message());
        }

        $this->setSupportToken($response->referenceId());
        $this->updateOrderAfterSuccessfulPayment();

        return $this->supportToken();
    }

    public function isSuccessful(Request $request): bool
    {
        return ($request->has('Authority') && $request->get('Status') === 'OK');
    }

    private function findOrder(Request $request) : Order|null
    {
        return $this->fetchOrder($request->get('Authority'));
    }

    protected function translateError($error_code) : string
    {
        return match($error_code) {
            -9 => 'خطای اعتبار سنجی',
            -10 => 'ای پی و يا مرچنت كد پذيرنده صحيح نيست',
            -11 => 'مرچنت کد فعال نیست لطفا با تیم پشتیبانی ما تماس بگیرید',
            -12 => 'تلاش بیش از حد در یک بازه زمانی کوتاه.',
            -15 => 'ترمینال شما به حالت تعلیق در آمده با تیم پشتیبانی تماس بگیرید',
            -16 => 'سطح تاييد پذيرنده پايين تر از سطح نقره اي است.',
            -30 => 'اجازه دسترسی به تسویه اشتراکی شناور ندارید',
            -31 => 'حساب بانکی تسویه را به پنل اضافه کنید مقادیر وارد شده واسه تسهیم درست نیست',
            -32 => 'Wages is not valid, Total wages(floating) has been overload max amount.',
            -33 => 'درصد های وارد شده درست نیست',
            -34 => 'مبلغ از کل تراکنش بیشتر است',
            -35 => 'تعداد افراد دریافت کننده تسهیم بیش از حد مجاز است',
            -40 => 'Invalid extra params, expire_in is not valid.',
            -50 => 'مبلغ پرداخت شده با مقدار مبلغ در وریفای متفاوت است',
            -51 => 'پرداخت ناموفق',
            -52 => 'خطای غیر منتظره با پشتیبانی تماس بگیرید',
            -53 => 'اتوریتی برای این مرچنت کد نیست',
            -54 => 'اتوریتی نامعتبر است'
        };
    }
}
