@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-md min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <x-front.card class="mt-10">
            <div class="flex gap-4 items-center p-4 mb-6 rounded-md bg-emerald-100 text-emerald-800">
                <x-ui.icon icon="remove-circle" class="!w-10 !h-10"></x-ui.icon>

                <div class="space-y-2 text-emerald-800">
                    <h3 class="text-2xl font-semibold">پرداخت با موفقیت انجام شد</h3>
                    <p class="text-lg">از اعتماد شما به آکادمی برنامه نویسی لاراپلاس سپاسگذاریم</p>
                </div>
            </div>

            <div class="mt-5">
                @include('front.payment._invoice')
            </div>

            <div class="mt-5 text-center">
                <a 
                    href="{{ route('dashboard') }}"
                    class="inline-block bg-rose-600 text-white py-3 px-4 rounded-md shadow-md hover:bg-emerald-800">
                    برو به دوره های من
                </a>
            </div>
        </x-front.card>
    </div>

@endsection
