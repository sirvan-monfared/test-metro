@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-12 mb-12">
            <h2 class="flex items-center gap-2 text-neutral-700">
                <x-ui.icon icon="orders" class="w-8 h-8"></x-ui.icon>
                <span class="text-2xl font-medium">سفارش های من</span>
            </h2>
        </div>

        <section class="grid grid-cols-12 lg:gap-12 mt-5 lg:mt-8">
            @include('front.dashboard._vertica_nav')

            <div class="col-span-12 lg:col-span-8">

                @include('flash')

                <div class="">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-base text-center text-gray-500">
                            <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    تاریخ
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    شناسه پیگیری
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    مبلغ
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    وضعیت پرداخت
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    عملیات
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($orders as $order)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $order->created_at->toJalali('Y/m/d | H:i') }}</td>
                                    <td class="px-6 py-4">{{ $order->support_token ?: 'ندارد' }}</td>
                                    <td class="px-6 py-4 font-semibold">{!! price_format($order->price) !!}</td>
                                    <td class="px-6 py-4"><span
                                            class="{{ $order->status->cssClass() }} py-1 px-2 text-white rounded text-sm">{{ $order->status->name() }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('dashboard.order.show', $order) }}"
                                           class="bg-blue-500 py-1 px-2 flex items-center justify-center rounded-sm text-sm text-white gap-1">
                                            <x-ui.icon icon="eye" class="!w-5 !h-5"></x-ui.icon>
                                            <span> مشاهده </span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <td colspan="6" class="px-6 py-4 text-lg text-center">هنوز هیچ پولی به ما ندادی!
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>


                {{-- <div class="card-item mt-30">
                <div class="table-responsive mt-30">
                    <table class="table orders__table text-center">
                        <thead class="thead-s">
                            <tr>
                                <th scope="col" class="d-none d-lg-block">شناسه سفارش</th>
                                <th scope="col">تاریخ </th>
                                <th scope="col" class="d-none d-lg-block">شناسه پیگیری </th>
                                <th scope="col">مبلغ</th>
                                <th scope="col">وضعیت پرداخت</th>
                                <th scope="col">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="d-none d-lg-block">{{ $order->order_token }}</td>
                                    <td>{{ $order->created_at->toJalali('Y/m/d ساعت H:i') }}</td>
                                    <td class="d-none d-lg-block">{{ $order->support_token }}</td>
                                    <td>{!! price_format($order->price) !!}</td>
                                    <td class="status"><span class="bg-{{ $order->status->cssClass() }} p-2 text-white rounded">{{ $order->status->name() }}</span></td>
                                    <td>
                                        <a href="{{ route('dashboard.order.show', $order) }}" class="btn btn-primary btn-sm">
                                            <x-ui.icon icon="eye" class="svg-20"></x-ui.icon> مشاهده
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">هنوز هیچ پولی به ما ندادی!</td>
                                </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> --}}


            </div>
        </section>
    </div>

@endsection
