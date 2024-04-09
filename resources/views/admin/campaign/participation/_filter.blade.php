<div class="w-100 mw-150px">
    <select name="campaign" class="form-select form-select-solid"  data-placeholder="وضعیت">
        <option value="">همه</option>
        @foreach($campaigns as $campaign)
            <option value="{{ $campaign->id }}" @selected($campaign->id == request()->campaign)>{{ $campaign->title }}</option>
        @endforeach
    </select>
</div>

<div class="card-title">
    <div class="d-flex align-items-center position-relative my-1">
        <span class="svg-icon svg-icon-1 position-absolute ms-4">
           <x-ui.icon icon="admin-search"></x-ui.icon>
        </span>
        <input type="text" name="user" value="{{ request()->user }}" class="form-control form-control-solid w-250px ps-14" placeholder="دانشجو (نام، موبایل، ایمیل یا ... " />
    </div>
</div>

<x-admin.date-picker-filter></x-admin-date-picker-filter>
