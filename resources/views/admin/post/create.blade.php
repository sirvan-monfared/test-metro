@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            <form method="POST" action="{{ route('admin.post.store') }}" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @csrf
                @method('POST')

                @include('admin.post._form')
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('admin/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/users-search.js') }}"></script>
    {{-- <script src="{{ asset('admin/plugins/custom/ckeditor5-custom/build/ckeditor.js') }}"></script> --}}
    <script src="{{ asset('admin/plugins/custom/ckeditor4/ckeditor.js') }}"></script>

    <script>
        startCKEditor4('body',  '{{ route('admin.api.upload') }}', '{{ csrf_token() }}');
        startCKEditor4('short', '{{ route('admin.api.upload') }}', '{{ csrf_token() }}');
    </script>
@endsection
