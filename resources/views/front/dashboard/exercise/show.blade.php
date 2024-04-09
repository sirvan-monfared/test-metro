@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-12 mb-12">
            <h2 class="flex items-center gap-2 text-neutral-700">
                <x-ui.icon icon="exercise" class="w-8 h-8"></x-ui.icon>
                <span class="text-2xl font-medium">{{ $exercise->title }}</span>
            </h2>
        </div>

        <section class="grid grid-cols-12 lg:gap-12 mt-5 lg:mt-8">
            @include('front.dashboard._vertica_nav')

            <div class="col-span-12 lg:col-span-5">

                @include('flash')


                <div class="border-2 bg-white border-dashed border-gray-300 p-5 rounded shadow-md mb-6">
                    @if ($exercise->isReviewed())
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl text-blue-500 font-semibold">نظر مربی دوره:</h3>

                            <rate-with-stars :show="true" :stars="{{ $exercise->rating }}"
                                             size="17"></rate-with-stars>
                        </div>
                        <div class="text-gray-800 text-base lg:text-lg leading-relaxed lg:leading-loose">
                            {!! $exercise->review !!}
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center gap-6">
                            <x-ui.icon icon="exercise" class="!w-12 !h-12"></x-ui.icon>
                            <p class="text-center">این تمرین هنوز توسط مربی دوره بازبینی نشده. بعد از بازبینی، میتونی
                                همینجا نظرات و نمره مربی به این تمرین رو مشاهده کنی. ممنونم که منتظر میمونی</p>
                        </div>
                    @endif
                </div>


                <x-front.card class="shadow-md space-y-3">
                    <h2 class="text-xl font-semibold mb-6">اطلاعات تمرین: </h2>

                    <h4 class="text-lg font-medium text-gray-800">{{ $exercise->title }}</h4>

                    <p class="text-gray-600">{{ $exercise->description }}</p>

                </x-front.card>
            </div>
            <div class="col-span-12 lg:col-span-3 space-y-2">
                <x-front.card class="p-5 flex items-center justify-between">
                    <span class="text-gray-800 font-semibold">وضعیت تمرین: </span>
                    <span
                            class="{{ $exercise->status->cssClass() }} text-white rounded-md py-1 px-2 text-sm">{{ $exercise->status->name() }}</span>
                </x-front.card>
                @if ($exercise->isReviewed())
                    <x-front.card class="p-5 flex items-center justify-between">
                        <span class="text-gray-800 font-semibold">نمره مربی: </span>
                        <span>
                            <rate-with-stars :show="true" :stars="{{ $exercise->rating }}"
                                             size="17"></rate-with-stars>
                        </span>
                    </x-front.card>
                @endif
                <x-front.card class="p-5 flex items-center justify-between">
                    <span class="text-gray-800 font-semibold">تاریخ ارسال:</span>
                    <span class="text-gray-800 text-sm">{{ $exercise->created_at->toJalali('Y/m/d') }}</span>
                </x-front.card>
                <x-front.card class="p-5 flex items-center justify-between">
                    <span class="text-gray-800 font-semibold">تاریخ آخرین بروزرسانی:</span>
                    <span class="text-gray-800 text-sm">{{ $exercise->updated_at->toJalali('Y/m/d') }}</span>
                </x-front.card>
            </div>
        </section>
    </div>
@endsection
