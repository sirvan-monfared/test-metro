<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <div class="col-md-6 fv-row">
                        <label id="user_id" class="required fs-6 fw-bold mb-2">کاربر</label>
                        <user-select></user-select>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="exp_points">میزان امتیاز اعطایی</label>
                    <input type="text" name="exp_points" id="exp_points" class="form-control mb-2" placeholder="مبلغ پرداخت شده" value="{{ old('exp_points') }}" />
                    <x-admin.error-field :errors="$errors" name="exp_points"></x-admin.error-field>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="reason">علت اعطای امتیاز</label>
                    <textarea type="text" name="reason" id="reason" class="form-control mb-2">{{ old('reason') }}</textarea>
                    <x-admin.error-field :errors="$errors" name="reason"></x-admin.error-field>
                </div>
            </div>
        </x-admin.card>

    </div>

    <div class="d-flex justify-content-between">
        <a href="{{ route('admin.points.index') }}" type="submit" class="btn btn-light me-5">
            <span class="indicator-label">انصراف</span>
        </a>

        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
            <span class="indicator-label">ذخیره تغییرات</span>
        </button>
    </div>
</div>
