@extends('front.layouts.main')

@section('content')
    <div class="container px-5 lg:max-w-screen-xl mx-auto">

        <div class="mt-5">
            <x-front.breadcrumbs :items="$breadCrumbs" class="lg:!text-base"></x-front.breadcrumbs>
        </div>


        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-12 md:gap-x-5">
            @foreach ($courses as $course)
                <x-front.course-item :course="$course"></x-front.course-item>
            @endforeach
        </div>

    </div>
@endsection
