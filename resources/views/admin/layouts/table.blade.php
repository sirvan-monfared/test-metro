@extends('admin.layouts.main')

@section('content')

        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="container-xxl" id="kt_content_container">
                <div class="card card-flush">
                    <form method="GET" action="">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                @yield('filter')

                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <button type="submit" class="btn btn-primary">جستجو </button>
                                </div>
                        </div>
                    </form>


                    <div class="card-body pt-0">
                        @include('admin.flash')
                        @yield('table')
                    </div>

                </div>
            </div>
        </div>

@endsection

@section('scripts')

    <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script src="{{ asset('admin/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
    <script src="{{ asset('admin/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('admin/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/users-search.js') }}"></script>
@endsection
