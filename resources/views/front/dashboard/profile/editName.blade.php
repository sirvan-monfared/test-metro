@extends('front.layouts.main')


@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl">

        <div class="py-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        @include('flash')
    </div>

    <div class="container px-3 mx-auto max-w-[500px] md:mt-8 min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="bg-white shadow-md rounded-md w-full pt-5 md:pt-3 px-9 pb-7">
            <h2 class="text-lg md:text-2xl font-medium py-6">لطفا اطلاعات خودت رو تکمیل کن</h2>
            <p>&nbsp</p>

            <form method="POST" action="{{ route('dashboard.profile.updateName') }}">
                @csrf
                @method('PATCH')

                <div class="ui search focus mt-15 text-sm-right">
                    <label class="inline-block mb-2 text-sm text-gray-600" for="name">نام و نام خانوادگی:</label>
                    <input type="text" id="name" name="name"
                        class="w-full bg-gray-100 outline-0 rounded-md border border-transparent focus:border focus:border-gray-300 focus:ring-0 focus:shadow-md hover:border hover:border-gray-300 hover:ring-0 hover:shadow-md">

                    @error('name')
                        <p class="text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <button class="mt-10 text-base font-medium text-center bg-rose-600 w-full rounded-md py-2 px-3 text-white" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
