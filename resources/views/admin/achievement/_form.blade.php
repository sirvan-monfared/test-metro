<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>
            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <div class="col-md-6 fv-row">
                        <label id="achievement_name" class="required fs-6 fw-bold mb-2">نشان افتخار</label>
                        <select name="achievement_name" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="نام نشان افتخار">
                            <option value="">انتخاب کنید</option>
                            @foreach($available_achievements as $achievement)
                                <option value="{{ $achievement->name }}">
                                    {{ $achievement->name }} -- {{ $achievement->description }} ({{ $achievement->xp_points }} امتیاز)
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <div class="col-md-6 fv-row">
                        <label id="user_id" class="required fs-6 fw-bold mb-2">کاربر</label>
                        <user-select></user-select>
                    </div>
                </div>
            </div>

        </x-admin.card>

    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
            <span class="indicator-label">ذخیره تغییرات</span>
        </button>
    </div>
</div>