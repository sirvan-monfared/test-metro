@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            @include('admin.flash')

            <form method="POST" action="{{ route('admin.coupon.update', $coupon) }}" class="form d-flex flex-column flex-lg-row">
                @csrf
                @method('PATCH')


                @include('admin.coupon._form')
                @include('admin.coupon._sidebar')

            </form>


        </div>
    </div>
@endsection

