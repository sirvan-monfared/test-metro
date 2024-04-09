@extends('admin.layouts.table', [
    'create_link' => route('admin.campaign.create')
])


@section('table')
    <table class="table align-middle table-row-dashed fs-6 gy-5">
        <thead>
        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" value="1"/>
                </div>
            </th>
            <th class="min-w-200px">عنوان </th>
            <th class="min-w-200px">نامک</th>
            <th class="min-w-200px">تعداد شرکت کننده ها</th>
            <th class="text-center min-w-100px">تاریخ ساخت</th>
            <th class="text-center min-w-70px">عملیات</th>
        </tr>
        </thead>

        <tbody class="fw-bold text-gray-600">
        @foreach($campaigns as $campaign)
            <tr>
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="{{ $campaign->id }}"/>
                    </div>
                </td>
                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $campaign->title }}</span>
                </td>
                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $campaign->slug }}</span>
                </td>
                <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $campaign->users_count }}</span>
                </td>
                 <td class="text-start pe-0">
                    <span class="fw-bolder ms-3">{{ $campaign->created_at->toJalali()->format('Y/m/d') }}</span>
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
                            <a href="{{ route('admin.campaign.edit', $campaign) }}" class="menu-link px-3">
                                <i class="fa fa-edit"></i> &nbsp; ویرایش
                            </a>
                        </div>

                        <div class="menu-item px-3">
                            <a href="{{ route('admin.campaign.participation.index', $campaign) }}" class="menu-link px-3">
                                <i class="fa fa-users"></i> شرکت کنندگان
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <delete-confirm action="{{ route('admin.campaign.destroy', $campaign) }}">
                                <button type="submit" class="btn menu-link px-3"><i class="fa fa-trash"></i> حذف</button>
                            </delete-confirm>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $campaigns->links() !!}
@endsection
