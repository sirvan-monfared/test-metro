@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            @include('admin.flash')

            <form method="POST" action="{{ route('admin.achievement.store') }}" class="form d-flex flex-column flex-lg-row">
                @csrf
                @method('POST')

                @include('admin.achievement._form')
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
