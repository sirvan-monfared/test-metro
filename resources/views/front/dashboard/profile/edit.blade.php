@extends('front.layouts.main')


@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl">

        <div class="py-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

    </div>

    <div class="container px-3 mx-auto max-w-[500px] mt-[50px] md:mt-8 min-h-[calc(100vh-8.93rem)] md:min-h-0">


        <form class="relative flex justify-center" method="POST" action="{{ route('dashboard.profile.update') }}"
              enctype="multipart/form-data">

            <div
                class="absolute top-0 w-[100px] h-[100px] -translate-y-[50px] lg:w-[150px] lg:h-[150px] lg:-translate-y-[75px] bg-white rounded-full border border-gray-100 shadow-sm">

                <div data-image-wrapper class="relative">
                    <div class="relative flex">
                        <div
                            class="bg-white inset-0 rounded-full w-[110px] h-[110px] lg:w-[160px] lg:h-[160px] shadow-md border-1 border-gray-100"></div>
                        <div
                            class="absolute rounded-full inset-0 bg-cover w-[100px] h-[100px] lg:w-[150px] lg:h-[150px]"
                            width="150" height="150" style="background-image: url({{ $user->featuredImage() }})"></div>
                        <div data-image-placeholder
                             class="absolute rounded-full inset-0 bg-cover w-[150px] h-[150px]"></div>
                    </div>
                    <label aria-label="تغییر تصویر حساب کاربری"
                           class="flex justify-center items-center absolute top-0 w-full h-full rounded-full cursor-pointer">
                        <input onchange="changeImage(this)" type="file" name="avatar" accept=".jpg, .jpeg, .png"
                               class="opacity-0 w-0 h-0 overflow-hidden">
                    </label>
                </div>
            </div>


            <div class="bg-white shadow-md rounded-md w-full pt-5 md:pt-3 px-9 pb-7">

                <h2 class="text-lg md:text-2xl font-medium py-6 mt-16 text-center">لطفا اطلاعات خودت رو تکمیل کن</h2>
                @include('flash', ['show_list' => false])
                <p>&nbsp</p>

                @csrf
                @method('PATCH')

                <x-front.input name="name" value="{{ $user->name }}">نام و نام خانوادگی:</x-front.input>

                <x-front.input name="telegram_id" value="{{ $user->meta?->telegram_id }}" class="mt-6">آیدی تلگرام (یا
                    شماره ای که با آن تلگرام دارید):
                </x-front.input>

                <x-front.selectbox name="education" value="{{ $user->meta?->education }}" :options="educationOptions()" class="mt-6">تحصیلات</x-front.selectbox>

                <div class="mt-6">
                    <label class="inline-block mb-2 text-sm text-gray-600">تاریخ تولد:</label>
                    <persian-date-picker initial="{{ old('birth_date', $user->meta?->birth_date) }}"></persian-date-picker>
                    <x-front.error-field name="birth_date"></x-front.error-field>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm text-gray-600 mb-2">جنسیت:</h3>
                    <ul class="grid grid-cols-12 w-full gap-6">
                        <li class="col-span-12 md:col-span-6">
                            <input type="radio" id="gender-male" name="gender" value="male" class="hidden peer" @checked(old('gender', $user->meta?->gender) === 'male')>
                            <label for="gender-male" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-sky-500 peer-checked:bg-sky-500 peer-checked:text-white hover:text-gray-600 hover:bg-gray-100">
                                <div class="block">
                                    <div class="w-full">مرد</div>
                                </div>
                            </label>
                        </li>
                        <li class="col-span-12 md:col-span-6">
                            <input type="radio" id="gender-female" name="gender" value="female" class="hidden peer"  @checked(old('gender', $user->meta?->gender) === 'female')>
                            <label for="gender-female" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-sky-500 peer-checked:bg-sky-500 peer-checked:text-white hover:text-gray-600 hover:bg-gray-100">
                                <div class="block">
                                    <div class="w-full">زن</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                    <x-front.error-field name="gender"></x-front.error-field>
                </div>

                <button
                    class="mt-10 text-base font-medium text-center bg-rose-600 w-full rounded-md py-2 px-3 text-white"
                    type="submit">ذخیره
                </button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script>
        function changeImage(input) {

            const reader = new FileReader();

            reader.onload = function (e) {
                console.log(input.closest('[data-image-wrapper]'))
                input.closest('[data-image-wrapper]').querySelector('[data-image-placeholder]').style['background-image'] = `url(${e.target.result})`;
            }

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
