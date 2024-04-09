@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-5 lg:mt-8 grid grid-cols-12 gap-y-12 gap-x-0 lg:gap-x-12">

            <div class="col-span-12 order-2 lg:col-span-4 lg:order-1 flex flex-col gap-8">
                <div class="bg-green-500 text-white flex flex-col items-center gap-6 p-5 rounded-lg">
                    <x-ui.icon icon="trophy" class="!w-40 !h-40"></x-ui.icon>
                    <span class="text-6xl">{{ number_format($total_points) }} امتیاز </span>
                </div>

                <div class="flex flex-col gap-4 mb-24">
                    <h3 class="font-semibold text-2xl">تابلوی افتخارات</h3>

                    <ul class="flex items-center gap-4">
                        @foreach($available_achievements as $achievement)
                            <x-front.dashboard.achievement_badge
                                :achievement="$achievement"></x-front.dashboard.achievement_badge>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-span-12 order-1 lg:col-span-8 lg:order-2 ">
                <ul class="flex flex-col gap-5">
                    @forelse ($history as $audit_item)
                        <x-front.dashboard.audit_item :item="$audit_item"></x-front.dashboard.audit_item>
                    @empty
                        <x-front.card class="">
                            <div class="lg:p-10 flex flex-col items-center text-center gap-10">
                                <img src="{{ asset('assets/img/achievements/reward.svg') }}" alt="reward icon" width="128" height="128">
                                <h4 class="text-3xl leading-normal lg:leading-loose">هنوز هیچ امتیازی کسب نکردی!</h4>
                                <p class="text-base text-gray-800 leading-loose">
                                    میدونستی با کارهای ساده ای مثل
                                    <a href="{{ route('dashboard.profile.edit') }}" class="text-blue-500 hover:text-orange-500 pb-1 border-b border-dashed border-current">تکمیل اطلاعات حساب کاربری</a> یا
                                     <a href="{{ route('dashboard.profile.edit') }}" class="text-blue-500 hover:text-orange-500 pb-1 border-b border-dashed border-current">آپلود تصویر آواتار</a>
                                    یا حتی
                                    <a href="{{ route('course.list') }}" class="text-blue-500 hover:text-orange-500 pb-1 border-b border-dashed border-current">خرید یکی از دوره های سایت</a>
                                    ، میتونی توی سایت امتیاز کسب کنی و از جایزه هاش استفاده کنی؟</p>
                            </div>
                        </x-front.card>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

@endsection
