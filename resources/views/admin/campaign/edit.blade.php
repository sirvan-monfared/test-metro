@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            @include('admin.flash')

            <form method="POST" action="{{ route('admin.campaign.update', $campaign) }}" class="form d-flex flex-column flex-lg-row">
                @csrf
                @method('PATCH')


                @include('admin.campaign._form')
                @include('admin.campaign._sidebar')
            </form>


        </div>
    </div>
@endsection

