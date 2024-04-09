<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-500px mb-7 me-lg-10">

    <!--begin::Category & tags-->
    <div class="card card-flush py-4">
        <div class="card-header">
            <div class="card-title">
                <h2>تاریخ انقضا </h2>
            </div>
        </div>

        <div class="card-body pt-0">

            <div class="mb-4">
                <persian-date-picker name="expires_at" initial="{{ $coupon->isExpirable() ? $coupon->expires_at->toJalali('Y/m/d') : null }}"/>
            </div>
            <label for="no_expiration">
                <input type="checkbox" class="form-conrol" name="no_expiration" id="no_expiration" value="1">
                <span> بدون انقضا </span>
            </label>
        </div>


        <div class="card-body pt-0">
            @livewire('status-picker', [
                'status' => $coupon->status(),
                'statusEnumClass' => App\Enums\Status::class,
                'title' => 'وضعیت'
            ])
        </div>
    </div>

</div>
