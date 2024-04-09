@extends('front.layouts.main')

@section('content')
    <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
        <div class="pt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        <div class="mt-12 mb-12">
            <h2 class="flex items-center gap-2 text-neutral-700">
                <x-ui.icon icon="shield" class="w-8 h-8"></x-ui.icon>
                <span class="text-2xl font-medium">کد هویت سنجی من</span>
            </h2>
        </div>

        <section class="grid grid-cols-12 lg:gap-12 mt-5 lg:mt-8">
            @include('front.dashboard._vertica_nav')

            <div class="col-span-12 lg:col-span-8">

                @include('flash')

                @if(! $user->hasApiKey())
                    <x-front.card>
                        <div class="flex flex-col items-center justify-center">
                            <h4 class="text-2xl font-semibold mt-4">هنوز کد هویت سنجی خودت رو نساختی!</h4>
                            <p class="mt-4 text-lg">با کلیک روی دکمه زیر، یک بار برای همیشه کد هویت سنجی خودت رو
                                بساز</p>
                            <form action="{{ route('dashboard.apikey.store') }}" method="POST" class="mt-8">
                                @csrf
                                <button type="submit"
                                        class="flex items-center justify-center gap-2 bg-rose-500 py-2 px-4 rounded-md shadow-md text-white text-lg hover:opacity-70">
                                    <x-ui.icon icon="shield" class="!w-8 !h-8"></x-ui.icon>
                                    <span>ساخت کد هویت سنجی</span>
                                </button>
                            </form>
                        </div>
                    </x-front.card>
                @else

                    <x-front.card>
                        <div class="flex flex-col items-center justify-center">
                            <x-ui.icon icon="shield" class="!w-28 !h-28"></x-ui.icon>
                            <h4 class="text-2xl font-semibold mt-4">میتونی کد هویت سنجی خودت رو از اینجا کپی کنی</h4>
                            <div class="mt-8 flex items-center w-full">

                                <input type="text" readonly name="api_key" id="api_key" value="{{ $user->meta->api_key }}"  class="w-full flex-1 bg-gray-100 outline-0 rounded-md border border-transparent text-center  focus:border focus:border-gray-300 focus:ring-0 focus:shadow-md hover:border hover:border-gray-300 hover:ring-0 hover:shadow-md">

                                <button id="copy-apikey" onclick="copyApiKey()" class="bg-rose-500 rounded-sm p-2 flex items-center justify-center gap-2 text-white hover:opacity-70">
                                    <x-ui.icon icon="copy"></x-ui.icon>
                                    <span class="text-sm" id="copy-apikey-text">کپی کن!</span>
                                </button>
                            </div>
                        </div>
                    </x-front.card>

                @endif


            </div>
        </section>
    </div>

@endsection

@section('scripts')
    <script>
        const copyApiKey = function() {
            const btnText = document.getElementById('copy-apikey-text');
            navigator.clipboard.writeText(document.getElementById('api_key').value);

            btnText.innerText = 'کپی شد!';
            setTimeout(() => {
                btnText.innerText = 'کپی کن!';
            }, 2000)
        };
    </script>
@endsection
