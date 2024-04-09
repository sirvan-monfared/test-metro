@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-md min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <x-front.card class="mt-10">
            <div class="flex gap-4 items-center p-4 mb-6 rounded-md bg-rose-100 text-rose-800">
                <x-ui.icon icon="remove-circle" class="!w-10 !h-10"></x-ui.icon>

                <div class="space-y-2 text-rose-800">
                    <h3 class="text-2xl font-semibold">پرداخت انجام نشد</h3>
                    <p class="text-lg">{{ $gateway_message }}</p>
                </div>
            </div>

            <div class="mt-5">
                @include('front.payment._invoice')
            </div>
        </x-front.card>
    </div>

@endsection
