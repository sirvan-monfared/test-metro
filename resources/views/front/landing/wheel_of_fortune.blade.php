@extends('front.layouts.main')

@section('content')
    <div class="bg-cover md:bg-center" style="background-image: url({{ asset('assets/img/landing/yalda.svg') }}); background-repeat: no-repeat;">
        <div class="container px-5 mx-auto lg:max-w-screen-xl min-h-[calc(100vh-8.93rem)] md:min-h-0">
            <div class="">
                <h2 class="flex items-center justify-center gap-2 text-neutral-700 py-8">
                    <span class="text-2xl md:text-4xl drop-shadow-md font-medium text-white">گردونه شانس یلدایی</span>
                </h2>
            </div>

            <section class="grid grid-cols-12 lg:gap-12 py-4 md:py-12">
                <div class="col-span-12">
                    <wheel-of-fortune></wheel-of-fortune>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('front/vendor/tsparticles-confetti/tsparticles.confetti.bundle.min.js') }}" defer></script>
    <script src="{{ asset('front/vendor/sweet-alert2/sweetalert2.11.js') }}"></script>
@endsection
