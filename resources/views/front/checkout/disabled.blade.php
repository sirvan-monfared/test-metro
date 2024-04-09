@extends('front.layouts.main')


@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">

        <div class="mt-5 lg:mt-8">

            <div class="d-flex flex-column gap-7 gap-lg-10">


                <div class="grid grid-cols-12 gap-x-3 gap-y-5">

                    <div class="col-span-12 flex flex-col gap-4">
                        <div class="bg-amber-300 border-2 border-amber-800 text-amber-800 p-5 rounded-md text-center space-y-2">
                            <p class="text-sm md:text-xl">متاسفانه درگاه پرداخت ما با مشکل مواجه شده</p>
                            <h3 class="text-2xl md:text-3xl">ولی اصلا جای نگرانی نیست!</h3>
                        </div>

                        <div class="bg-sky-300 border-2 border-sky-900 text-sky-900 p-5 rounded-md text-center flex flex-col gap-12">
                            <h3 class="text-lg md:text-2xl">میتونی هزینه سفارش رو اینطوری برامون واریزکنی</h3>

                            <div class="flex flex-col">
                                <p class="text-lg md:text-2xl">مبلغ <span class="font-bold">{!! price_format($order->price) !!}</span> به شماره کارت:</p>
                                <div class="border-2 rounded-md border-dashed p-3 mt-6 border-sky-900">
                                    <p class="text-lg md:text-3xl tracking-wider">{{ config('payment.cart_number') }}</p>
                                    <p class="text-sm md:text-xl mt-2">به نام علی گرشاسبی - بانک ملت </p>
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <p class="text-sm md:text-xl mt-2">بعد از واریز هم کافیه با هرکدوم از راه های زیر که خواستی به ما اطلاع بدی تا در اسرع وقت دوره ها رو برات فعال کنیم. به همین سادگی!</p>

                                <div class="max-w-screen-sm mx-auto flex items-center justify-center flex-wrap gap-2 mt-6">
                                    <div class="group">
                                        <a href="https://t.me/laraplus_ir" target="_blank" class="group-hover:bg-sky-100 transition-all duration-300 rounded-md border border-sky-800 flex items-center gap-2 py-1 px-2" aria-label="instagram account">
                                            <x-ui.icon icon="telegram" class="!w-8 !h-8 rotate-45"></x-ui.icon>
                                            <span>تلگرام</span>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="https://www.instagram.com/sirvan_monfared" target="_blank" class="group-hover:bg-sky-100 transition-all duration-300 rounded-md border border-sky-800 flex items-center gap-1 py-1 px-2" aria-label="instagram account">
                                            <x-ui.icon icon="instagram" class="!w-8 !h-8"></x-ui.icon>
                                            <span>اینستاگرام</span>
                                        </a>
                                    </div>
                                    <div class="group">
                                        <a href="https://wa.me/989114899693" target="_blank" class="group-hover:bg-sky-100 transition-all duration-300 rounded-md border border-sky-800 flex items-center gap-1 py-1 px-2" aria-label="instagram account">
                                            <x-ui.icon icon="whatsapp" class="!w-8 !h-8"></x-ui.icon>
                                            <span>واتس اپ</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-span-12">
                        <x-front.card >
                            <h2 class="mt-2 text-2xl text-gray-500 font-medium">جزئیات سفارش</h2>
                            <p class="text-gray-400 mt-2">شماره سفارش: {{ $order->order_token }}</p>
                            <p class="text-gray-400 mt-2"> تاریخ ثبت: {{ $order->created_at->toJalali('Y/m/d - H:i') }}</p>

                            <div class="overflow-x-auto relative mt-5">
                                <table class="w-full">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="text-right text-gray-400 font-semibold">
                                            <th class="py-3">نام دوره</th>
                                            <th class="py-3 text-end hidden lg:block">تعداد</th>
                                            <th class="py-3 text-end">قیمت واحد</th>
                                            <th class="py-3 text-end">مجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mt-3 font-medium text-gray-400">
                                        @foreach ($order?->items() as $item)
                                            <tr>
                                                <td>
                                                    <div class="flex items-center">
                                                        <a href="{{ $item->model()->viewLink() }}">
                                                            <img src="{{ $item->model()->featuredImage() }}" alt="{{ $item->model()->title }}" class="w-14 h-14 rounded-md">
                                                        </a>
                                                        <div class="mr-2">
                                                            <a href="{{ $item->model()->viewLink() }}" class="font-semibold text-gray-600">{{ $item->title() }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end hidden lg:block">{{ $item->qty() }}</td>
                                                <td class="text-end">{!! price_format($item->price()) !!}</td>
                                                <td class="text-end">{!! price_format($item->subtotal()) !!}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-end py-2">مجموع سبد خرید</td>
                                            <td class="text-end py-2">{!! price_format($order->subtotal()) !!}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end py-2">تخفیف</td>
                                            <td class="text-end py-2">{!! price_format($order->totalDiscount()) !!}</td>
                                        </tr>
                                        <tr class="text-xl">
                                            <td colspan="3" class="fs-3 text-black text-end py-5">قیمت نهایی</td>
                                            <td class="text-black fs-3 text-end py-5">{!! price_format($order->totalPrice()) !!}
                                            </td>
                                        </tr>
                                        @if($order->hasDiscount())
                                            <tr>
                                                <td class="text-dark fw-boldest text-start">
                                                    <span>کد تخفیف </span> <span>{{ data_get($order->discount(), 'coupon_prcent') }}</span> <span> درصد </span>
                                                    <span> {{ data_get($order->discount(), 'coupon_code') }} </span>
                                                    <span> | {{ data_get($order->discount(), 'coupon_description') }}</span> 
                                                    <span> در  این سفارش استفاده شده است</span>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </x-front.card>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection
