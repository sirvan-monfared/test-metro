@extends('admin.layouts.main')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-lg-n2 me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary">Order Summary</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_history">Order History</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Button-->
                    <a href="../../demo9/dist/apps/ecommerce/sales/listing.html" class="btn btn-icon btn-light-primary btn-sm ms-auto me-lg-n7">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <a href="../../demo9/dist/apps/ecommerce/sales/edit-order.html" class="btn btn-light-primary btn-sm me-lg-n7">Edit Order</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <a href="../../demo9/dist/apps/ecommerce/sales/add-order.html" class="btn btn-light-primary btn-sm">Add New Order</a>
                    <!--end::Button-->
                </div>
                <!--begin::Order summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>جزئیات نام نویسی (#{{ $enrollment->id }})</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">تاریخ نام نویسی</div>
                                        </td>
                                        <td class="fw-bolder text-start">{{ $enrollment->created_at->toJalali('Y/m/d ساعت H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">نحوه پرداخت</div>
                                        </td>
                                        <td class="fw-bolder text-start">
                                            {{ $enrollment->order->gateway?->name() ?: 'بدون پرداخت' }}
                                            @if ($enrollment->order->gateway)
                                                <img src="{{ asset($enrollment->order->gateway->logo()) }}" class="w-50px ms-2" />
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">مبلغ پرداخت شده</div>
                                        </td>
                                        <td class="fw-bolder text-start">{!! price_format($enrollment->order->price) !!}</td>
                                    </tr>
                                    <!--end::Date-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order details-->
                    <!--begin::Customer details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>مشخصات دانشجو</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">نام</div>
                                        </td>
                                        <td class="fw-bolder text-start">
                                            <div class="d-flex align-items-center justify-content-start gap-3">
                                                <a href="{{ route('admin.user.show', $enrollment->student) }}" class="text-gray-600 text-hover-primary">{{$enrollment->student->name}}</a>

                                                <div class="symbol symbol-circle overflow-hidden me-3 ">
                                                    <a href="{{ route('admin.user.show', $enrollment->student) }}">
                                                        <img src="{{ $enrollment->student?->featuredImage() }}" alt="{{ $enrollment->student?->publicName() }}" class="w-50px h-50px rounded-circle" />
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">ایمیل</div>
                                        </td>
                                        <td class="fw-bolder text-start">
                                            <a href="mailto:{{ $enrollment->student?->email }}" class="text-gray-600 text-hover-primary">{{ $enrollment->student?->email }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">تلفن</div>
                                        </td>
                                        <td class="fw-bolder text-start">{{ $enrollment->student?->phone }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Customer details-->
                    <!--begin::Documents-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>مشخصات دوره</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">نام دوره</div>
                                        </td>
                                        <td class="fw-bolder text-start">
                                            <a href="#" class="text-gray-600 text-hover-primary">{{ $enrollment->course?->title }}</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">درجه سختی</div>
                                        </td>
                                        <td class="fw-bolder text-start">
                                            <a href="#" class="text-gray-600 text-hover-primary">{{ $enrollment->course->level->name() }}</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">وضعیت</div>
                                        </td>
                                        <td class="fw-bolder text-start">{{ $enrollment->course->status->name() }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Documents-->
                </div>
                <!--end::Order summary-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title flex gap-3">
                                        <h2>جزئیات پرداخت #{{$enrollment->order->id}}</h2>
                                        <span class="{{ $enrollment->order->status->cssClass() }} px-2 py-1 text-white">{{ $enrollment->order->status->name() }}</span>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <!--begin::Table head-->
                                            <thead>
                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                <th class="min-w-175px">نام دوره</th>
                                                <th class="min-w-100px text-end">تعداد</th>
                                                <th class="min-w-100px text-end">قیمت واحد</th>
                                                <th class="min-w-100px text-end">مجموع</th>
                                            </tr>
                                            </thead>
                                            <tbody class="fw-bold text-gray-600">
                                                @foreach($enrollment->order?->items() as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="{{ $item->model()->viewLink() }}" class="symbol symbol-50px">
                                                                    <span class="symbol-label" style="background-image:url({{ $item->model()->featuredImage() }});"></span>
                                                                </a>
                                                                <div class="ms-5">
                                                                    <a href="{{ $item->model()->viewLink() }}" class="fw-bolder text-gray-600 text-hover-primary">{{ $item->title() }}</a>
                                                                    <div class="fs-7 text-muted">تاریخ نام نویسی: {{ $enrollment->created_at->toJalali('Y/m/d ساعت H:i:s') }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-end">{{ $item->qty() }}</td>
                                                        <td class="text-end">{!! price_format($item->price()) !!}</td>
                                                        <td class="text-end">{!! price_format($item->subtotal()) !!}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3" class="text-end">مجموع سبد خرید</td>
                                                    <td class="text-end">{!! price_format($enrollment->order->subtotal()) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end">تخفیف</td>
                                                    <td class="text-end">{!! price_format($enrollment->order->totalDiscount()) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-dark text-end">قیمت نهایی</td>
                                                    <td class="text-dark fs-3 fw-boldest text-end">{!! price_format($enrollment->order->totalPrice()) !!}</td>
                                                </tr>
                                                @if($enrollment->order->description)
                                                    <tr>
                                                        <td class="text-dark fw-boldest text-start">{{ $enrollment->order->description }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Product List-->
                        </div>
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->

                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Order details page-->
        </div>
        <!--end::Container-->
    </div>
@endsection
