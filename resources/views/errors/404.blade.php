@extends('front.layouts.main', [
    'no_content' => true,
    'body_class' => 'coming_soon_style'
])
@section('content')
    <div class="coming_soon_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cmtk_group">
                        <div class="ct-logo">
                            <a href="/">
                                <img src="{{ asset('assets/img/laraplus-with-text.svg') }}" alt="لاراپلاس مرجع دوره های مربی محور برنامه نویسی وب ">
                            </a>
                        </div>
                        <div class="cmtk_dt">
                            <h1 class="title_404">404</h1>
                            <h4 class="thnk_title1">به نظر میاد که گم شدی!</h4>
                            <p class="thnk_desc1">حالا که تا اینجا اومدی یه سر به دوره های سایت بزن</p>
                            <a href="{{ route('course.list') }}" class="bk_btn">دوره های آموزشی لاراپلاس</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
