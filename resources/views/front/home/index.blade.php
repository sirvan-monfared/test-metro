@extends('front.layouts.main', [
    'wrapper_class' => 'with-hero',
    'canonical_url' => 'https://laraplus.ir',
    'page_image' => asset('assets/img/laraplus-with-text.svg'),
    'page_type' => 'website',
    'page_schema' => $page_schema,
])

@section('content')
    

    @include('front.home._hero')

    @include('front.home._features')

    

    <section class="container px-5 mt-[80px] lg:mt-[100px] mb-5 mx-auto lg:max-w-screen-xl " id="courses">
        <h2 class="font-bold text-2xl lg:text-3xl text-center">دوره های برنامه نویسی آکادمی لاراپلاس</h2>

        <div class="mt-8 lg:mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-12 md:gap-x-5">
            @foreach($courses as $course)
                <x-front.course-item :course="$course"></x-front.course-item>
            @endforeach
            
        </div>
    </section>
@endsection
