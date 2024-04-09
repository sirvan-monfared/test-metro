@extends('front.layouts.main')


@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">

        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-5 lg:mt-8">

            <div class="d-flex flex-column gap-7 gap-lg-10">


                <div class="grid grid-cols-12 gap-x-3 gap-y-5">

                    <div class="col-span-12 md:col-span-6 lg:col-span-4">

                        <x-front.card class="h-full">
                            <h2 class="text-2xl text-gray-500 font-medium">جزئیات نام نویسی</h2>

                            <table class="mt-5 table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="font-medium text-gray-700">
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center">تاریخ نام نویسی</div>
                                        </td>
                                        <td class="font-semibold text-start px-4 py-4">
                                            {{ $enrollment->created_at->toJalali('Y/m/d ساعت H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center">نحوه پرداخت</div>
                                        </td>
                                        <td class="font-semibold text-start flex items-center px-4 py-4">
                                            <span>{{ $order->gateway->name() }}</span>
                                            <img src="{{ asset($order->gateway->logo()) }}" class="w-10 mr-2" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center">مبلغ پرداخت شده</div>
                                        </td>
                                        <td class="font-semibold text-start flex items-center px-4 py-4">
                                            {!! price_format($order->price) !!}</td>
                                    </tr>
                                    <!--end::Date-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </x-front.card>

                    </div>


                    <div class="col-span-12 md:col-span-6 lg:col-span-4">

                        <x-front.card class="h-full">
                            <h2 class="text-2xl text-gray-500 font-medium">مشخصات دانشجو</h2>

                            <table class="mt-5 table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="font-medium text-gray-700">
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center"> نام </div>
                                        </td>
                                        <td class="font-semibold text-start px-4 py-4">
                                            {{ $enrollment->student->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center">ایمیل </div>
                                        </td>
                                        <td class="font-semibold text-start flex items-center px-4 py-4">
                                            {{ $enrollment->student?->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center">تلفن </div>
                                        </td>
                                        <td class="font-semibold text-start flex items-center px-4 py-4">
                                            {{ $enrollment->student?->phone }}</td>
                                    </tr>
                                    <!--end::Date-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                        </x-front.card>

                    </div>


                    <div class="col-span-12 md:col-span-12 lg:col-span-4">

                        <x-front.card class="h-full">
                            <h2 class="text-2xl text-gray-500 font-medium">مشخصات دوره</h2>

                            <table class="mt-5 table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="font-medium text-gray-700">
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center"> نام دوره </div>
                                        </td>
                                        <td class="font-semibold text-start px-4 py-4">
                                            {{ $enrollment->course?->title }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-400 pl-4 py-4">
                                            <div class="flex items-center">وضعیت </div>
                                        </td>
                                        <td class="font-semibold text-start flex items-center px-4 py-4">
                                            {{ $enrollment->course->status->name() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </x-front.card>

                    </div>

                    <div class="col-span-12">
                        <x-front.card >
                            <h2 class="mt-2 text-2xl text-gray-500 font-medium">جزئیات پرداخت</h2>

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
                                                            <div class="text-xs text-muted py-2">تاریخ نام نویسی:
                                                                {{ $enrollment->created_at->toJalali('Y/m/d ساعت H:i:s') }}
                                                            </div>
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
