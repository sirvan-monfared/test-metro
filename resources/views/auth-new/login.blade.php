@extends('front.layouts.main', [
    'minimal' => true,
])

@section('content')
    <div class="container mx-auto max-w-[500px] md:mt-16">
        <div class="bg-white shadow-md rounded-md w-full pt-32 md:pt-3 px-12 pb-7 h-screen md:h-auto">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <login-form></login-form>
        </div>
    </div>
@endsection
