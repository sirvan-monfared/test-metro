@extends('front.layouts.main')


@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0 relative">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-12 mb-12">
            <h2 class="flex flex-col text-center lg:flex-row items-center gap-2 text-neutral-700">
                <x-ui.icon icon="exercise" class="w-8 h-8"></x-ui.icon>
                <span class="text-xl lg:text-2xl font-medium leading-relaxed">ارسال تمرینات دوره {{ $course->title }}</span>
            </h2>
        </div>

        <section class="grid grid-cols-12 lg:gap-12 mt-5 lg:mt-8">
            @include('front.dashboard._vertica_nav')

            <div class="col-span-12 lg:col-span-8">

                @include('flash')

                <form method="POST" action="{{ route('dashboard.course.exercise.store', $course) }}">
                    @csrf
                    <x-front.card class="!p-5">

                        <div class=" mb-12">
                            <h5 class="text-lg font-semibold">عنوان تمرین <span class="text-rose-800">*</span></h5>

                            <input type="text" id="title" name="title"
                                   class="w-full outline-0 rounded-md border mt-2 border-gray-300 focus:border focus:border-blue-500 focus:ring-0" value="{{ old('title') }}">
                        </div>

                        <div class="ui search focus mt-15 text-sm-right text-sm">
                            <h5 class="text-lg font-semibold">توضیحات تمرین: <span class="text-rose-800">*</span></h5>
                            <p class="text-gray-600 mt-2">توضیحات تمرینی که انجام دادی رو در این قسمت بنویس. مثلا اینکه
                                از چه ابزارهایی استفاده کردی؟ تا چه قسمتی از دوره رو مشاهده کردی، به چه چالش هایی برخورد
                                کردی و ...</p>
                            <textarea id="description" name="description" rows="5" class="w-full outline-0 rounded-md border mt-2 border-gray-300 focus:border focus:border-blue-500 focus:ring-0">{{ old('description') }}</textarea>
                            @error('name')
                            <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-12 text-sm">
                            <h5 class="text-lg font-semibold">آپلود فایل تمرین</h5>
                            <p class="text-gray-600 mt-2 flex items-center gap-2">
                                <x-ui.icon icon="check" class="text-green-600"></x-ui.icon>
                                <span>فایل رو بصورت زیپ شده (zip) برام بفرست. اگه نمیدونی چطور باید فایل رو زیپ کنی اینجا کلیک
                                کن</span>
                            </p>
                            <p class="text-gray-600 mt-2 mb-6  flex items-start gap-2">
                                <x-ui.icon icon="check" class="text-green-600"></x-ui.icon>
                                <span>حجم فایل نهایتا میتونه 5 مگابایت باشه. بنابراین اگه توی پروژه ات تصویر یا فایل با حجم
                                زیاد داری، اونها رو از فایل زیپ حذف کن</span>
                            </p>

                            <exercise-upload url="{{ route('dashboard.course.exercise.upload', $course) }}" csrf="{{ csrf_token() }}"></exercise-upload>
                        </div>

                        <div class="mt-12 mb-6 text-sm">
                            <h5 class="text-lg font-semibold">لینک فایل</h5>
                            <p class="text-gray-600 mt-2 flex items-center gap-2">
                                <x-ui.icon icon="check" class="text-green-600"></x-ui.icon>
                                <span>اگر حجم فایلت زیاد بود میتونی فایل رو جای دیگه آپلود کنی و لینکش رو اینجا بفرستی</span>
                            </p>
                            <input type="text" id="link" name="link" value="{{ old('link') }}"
                                   class="text-left ltr w-full outline-0 rounded-md border mt-2 border-gray-300 focus:border focus:border-blue-500 focus:ring-0">
                        </div>

                        <div class="text-left">
                            <x-button class="bg-blue-500 text-base">ارسال تمرین</x-button>
                            <button type="submit" class=""></button>
                        </div>

                    </x-front.card>
                </form>
            </div>
        </section>
    </div>

@endsection
