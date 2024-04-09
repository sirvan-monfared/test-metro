@extends('front.layouts.main', [
    'minimal' => true,
])

@section('content')
    <div class="container mx-auto max-w-[500px] mt-16">
        <div class="bg-white shadow-md rounded-md w-full pt-3 px-12 pb-7">

            <forget-password></forget-password>
        </div>
    </div>
@endsection
