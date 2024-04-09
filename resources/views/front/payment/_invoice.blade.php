<div class="flex items-center justify-between flex-wrap">
    <h2 class="text-3xl text-gray-800 font-medium">صورتحساب</h2>
    <x-ui.order-status :status="$order->status"></x-ui.order-status>
</div>

<div class="mt-5 flex gap-5 flex-wrap">
    <ul class="text-sm flex-1 space-y-2">
        <li>
            <strong class="text-neutral-400 font-medium">شماره سفارش: </strong>
            <span class="text-neutral-800 text-base">{{ $order->order_token }}</span>
        </li>
        <li>
            <strong class="text-neutral-400 font-medium">شماره پیگیری: </strong>
            <span class="text-neutral-800 text-base">{{ $order->support_token ?? '---' }}</span>
        </li>
        <li>
            <strong class="text-neutral-400 font-medium">تاریخ پرداخت: </strong>
            <span class="text-neutral-800 text-base">{{ $order->created_at->toJalali('Y/m/d ساعت H:i') }}</span>
        </li>
        
    </ul>

    <ul class="space-y-3">
        <li>
            <strong class="text-neutral-400 font-medium">درگاه پرداخت: </strong>
            <span class="text-neutral-800 text-base">{{ $order->gateway->name() }}</span>
        </li>
        <li>
            <img src="{{ asset($order->gateway->logo()) }}" class="h-10 rounded-md">
        </li>
    </ul>
</div>


<div class="mt-5 flex flex-col overflow-x-auto">
    <div class="sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="min-w-full text-right text-sm font-light">
                    <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">نام دوره</th>
                            <th scope="col" class="px-6 py-4">قیمت</th>
                            <th scope="col" class="px-6 py-4">تعداد</th>
                            <th scope="col" class="px-6 py-4">مجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items() as $item)
                            <tr class="border-b dark:border-neutral-500">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->title() }}</td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{!! price_format($item->price()) !!}</td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->qty() }}</td>
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{!! price_format($item->subtotal()) !!}</td>
                            </tr>
                        @endforeach

                        <tr class="-500 text-right">
                            <td class="whitespace-nowrap py-4 px-6 font-medium text-lg">
                                <div class="totalinv2">تخفیف : {!! price_format($order->totalDiscount()) !!}</div>
                                <p>{!! data_get($order->discount(), 'coupon_description') !!}</p>
                            </td>
                        </tr>

                        <tr class="-500 text-right">
                            <td class="whitespace-nowrap py-4 px-6 font-medium text-lg">
                                <div class="totalinv2">قیمت نهایی : {!! price_format($order->totalPrice()) !!}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
