@extends('admin.layouts.table', [
    'create_link' => route('admin.course.create'),
    'page_title' => 'دوره ها',
])

@section('table')
    <table class="table align-middle table-row-dashed fs-6 gy-5">
        <thead>
            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
                    </div>
                </th>
                <th class="min-w-200px">نام دوره</th>
                <th class="text-center min-w-100px">قیمت</th>
                <th class="text-center min-w-70px">سطح سختی</th>
                <th class="text-center min-w-100px">امتیاز</th>
                <th class="text-center min-w-100px">تعداد دانشجویان</th>
                <th class="text-center min-w-100px">وضعیت</th>
                <th class="text-center min-w-70px">عملیات</th>
            </tr>
        </thead>

        <tbody class="fw-bold text-gray-600">
            @foreach($courses as $course)
            <tr>
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="{{ $course->id }}" />
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('course.show', $course) }}" class="symbol symbol-50px">
                            <span class="symbol-label" style="background-image: url({{ $course->featuredImage() }});"></span>
                        </a>
                        <div class="ms-5">
                            <a href="{{ route('admin.course.edit', $course) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">
                                {{ $course->title }}
                            </a>
                        </div>
                    </div>
                </td>
                <td class="text-start pe-0">
                    <span class="fw-bolder">{!! $course->showPrice() !!}</span>
                </td>
                <td class="text-start pe-0" data-order="16">
                    <span class="fw-bolder ms-3">{{ $course->level->name() }}</span>
                </td>

                <td class="text-start pe-0" data-order="rating-3">
                    <x-star-rate></x-star-rate>
                </td>

                <td class="text-center pe-0">
                    <span class="fw-bolder"><a href="{{ route('admin.enrollment.index', ['course_id' => $course->id]) }}" target="_blank">{{ $course->active_students_count }}</a></span>
                </td>

                <td class="text-start" data-order="Published">
                    <div class="badge badge-light-{{ $course->status->color() }}">{{ $course->status->name() }}</div>
                </td>
                <td class="text-start">
                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"> عملیات
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                            </svg>
                        </span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="{{ route('admin.course.edit', $course) }}" class="menu-link px-3">
                                <i class="fa fa-edit"></i> &nbsp; ویرایش
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ route('admin.lesson.course', $course) }}" class="menu-link px-3">
                                <i class="fa fa-edit"></i> &nbsp;  درس ها
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ route('admin.course.comment.index', $course) }}" class="menu-link px-3">
                                <i class="fa fa-comment"></i> &nbsp; دیدگاه ها
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            {{-- <delete-confirm action="{{ route('admin.course.destroy', $course) }}">
                                <button type="submit" class="btn menu-link px-3"><i class="fa fa-trash"></i> حذف</button>
                            </delete-confirm> --}}
                        </div>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $courses->links() !!}
@endsection

