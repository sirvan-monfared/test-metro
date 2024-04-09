@extends('admin.layouts.table')

@section('filter')
    @include('admin.campaign.participation._filter')
@endsection

@section('table')
    <table class="table align-middle table-row-dashed fs-6 gy-5">
        <thead>
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" value="1"/>
                </div>
            </th>
            <th class="min-w-200px">عنوان کمپین </th>
            <th class="min-w-200px">کاربر</th>
            <th class="text-center min-w-100px">جایزه</th>
            <th class="text-center min-w-70px">کدجایزه</th>
            <th class="text-center min-w-70px">توضیحات</th>
            <th class="text-center min-w-70px">تاریخ</th>
            <th class="text-center min-w-70px">عملیات</th>
        </tr>
        </thead>

        <tbody class="fw-bold text-gray-600">
        @foreach($participations as $participation)
            <tr>
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="{{ $participation->id }}"/>
                    </div>
                </td>
                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $participation->campaign->title }}</a></span>
                </td>
                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3"><a href="{{ route('admin.user.show', $participation->user) }}">{{ $participation->user->publicName() }}</a></span>
                </td>

                 <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $participation->prize_title }}</span>
                 </td>

                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $participation->prize }}</span>
                 </td>

                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $participation->prize_description }}</span>
                </td>

                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $participation->created_at->toJalali()->format('Y/m/d') }}</span>
                </td>

                <td class="text-start">
                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click"
                       data-kt-menu-placement="bottom-end">عملیات
                        <x-ui.icon icon="admin-caret"></x-ui.icon>
                    </a>
                    <div
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                        data-kt-menu="true">

                        <div class="menu-item px-3">
                            <a href="{{ route('admin.campaign.participation.show', [$participation->campaign, $participation->id]) }}" class="menu-link px-3">
                                <i class="fa fa-eye"></i> &nbsp; مشاهده
                            </a>
                        </div>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $participations->links() !!}
@endsection
