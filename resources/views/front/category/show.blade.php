@extends('front.layouts.main')

@section('content')
    <div class="rtl">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 mb-4">
                    <h1>دسته بندی: {{ $category->title }}</h1>
                </div>

                <x-front.search></x-front.search>

                <div class="col-md-12">
                    <div class="_14d25">
                        <div class="row">
                            @foreach($courses as $course)
                                <x-front.course-item :course="$course"></x-front.course-item>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
