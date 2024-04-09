@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="row gy-5 g-xl-10 mt-10 mb-10">
            <div class="col-xl-2"></div>
            <div class="col-xl-8 mb-5 mb-xl-10">
                <!--begin::Tables widget 6-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder text-gray-800">لیگ برتر امتیازات!</span>
                        </h3>
                        <div class="card-toolbar d-flex gap-2">
                            <a href="{{ route('admin.points.create') }}" class="btn btn-sm btn-primary">اعطای امتیاز</a>
                            <a href="{{ route('admin.achievement.create') }}" class="btn btn-sm btn-secondary">اعطای نشان</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-pills-custom mb-3">
                            <li class="nav-item mb-3 me-3 me-lg-6">
                                <a class="nav-link btn btn-outline btn-flex btn-active-color-primary flex-column overflow-hidden  h-85px pt-5 pb-2 active"
                                   data-bs-toggle="pill" href="#leaderboard_tab">

                                    <div class="nav-icon mb-3">
                                        <i class="fonticon-star fs-2x p-0"></i>
                                    </div>
                                    <span class="nav-text text-gray-800 fw-bolder fs-6 lh-1">برترین کاربران</span>
                                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                </a>
                            </li>
                        </ul>

                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="leaderboard_tab">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                        <thead>
                                        <tr class="fs-7 fw-bolder text-gray-500 border-bottom-0">
                                            <th class="p-0 w-50px"></th>
                                            <th class="p-0 w-200px w-xxl-450px"></th>
                                            <th class="p-0 min-w-150px"></th>
                                            <th class="p-0 min-w-150px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaderboard as $index => $user)
                                            <tr>
                                                <td class="fs-2x text-center text-gray-500">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-40px me-3">
                                                            <img src="{{ $user->featuredImage() }}" class="" alt="avatar"/>
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="{{ route('admin.user.show', $user) }}" target="_blank" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $user->publicName() }}</a>
                                                            <span class="text-muted fw-bold text-muted d-block fs-7">عضو لاراپلاس از{{ $user->created_at->toJalali('Y/m/d') }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800 fw-bolder d-block mb-1 fs-6">{{ number_format($user->getPoints()) }}</span>
                                                    <span class="fw-bold text-gray-400 d-block">مجموع امتیازات</span>
                                                </td>
                                                <td>
                                                    <a href="#"
                                                       class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">0</a>
                                                    <span class="text-muted fw-bold text-muted d-block fs-7">سطح کاربری</span>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>

                        </div>
                        <!--end::Tab Content-->
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end::Tables widget 6-->
            </div>
        </div>
    </div>
@endsection

