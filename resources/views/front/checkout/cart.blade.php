@extends('front.layouts.main')

@section('content')
    <x-container>
        <div class="py-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>

        @include('front.partials.flash-session')
        
        <div class="grid grid-cols-12 gap-y-5 lg:gap-x-5">
            <cart-layout :cart-items="{{ cart()->contentToJson() }}"></cart-layout>
        </div>


    </x-container>
@endsection
