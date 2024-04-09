@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">

            @include('admin.flash')

            <form method="POST" action="{{ route('admin.exercise.update', $exercise) }}" class="form d-flex flex-column flex-lg-row">
                @csrf
                @method('PATCH')


                @include('admin.exercise._sidebar')
                @include('admin.exercise._form')


                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-200px mb-7 me-lg-10">
                    @if($exercise->files)
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>فایل تمرین</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <a href="{{ $exercise->files->downloadLink() }}" class="d-flex">
                                    <i class="bi bi-file-earmark-zip fs-5tx text-gray-800"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

            </form>


        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/plugins/custom/ckeditor5-custom/build/ckeditor.js') }}"></script>

    <script>
        startCKEditor('#review');
    </script>
@endsection
