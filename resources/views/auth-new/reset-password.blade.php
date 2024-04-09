@extends('front.layouts.main', [
    'minimal' => true,
])

@section('content')
    <div class="container mx-auto max-w-[500px] md:mt-16">
        <div class="bg-white shadow-md rounded-md w-full pt-32 md:pt-3 px-12 pb-7 h-screen md:h-auto">
            <reset-password reset-token="{{ request()->route('token') }}"></reset-password>
        </div>
    </div>
@endsection
