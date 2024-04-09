<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 me-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="code">کد تخفیف</label>
                    <input type="text" name="code" id="code" class="form-control mb-2" placeholder="کدتخفیف" value="{{ $coupon->code }}" />
                    <x-admin.error-field :errors="$errors" name="code"></x-admin.error-field>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="percent">درصد تخفیف</label>
                    <input type="text" name="percent" id="percent" class="form-control mb-2" placeholder="کدتخفیف" value="{{ $coupon->percent }}" />
                    <x-admin.error-field :errors="$errors" name="percent"></x-admin.error-field>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="description">توضیحات</label>
                    <textarea type="text" name="description" id="description" class="form-control mb-2" rows="5">{{ $coupon->description }}</textarea>
                    <x-admin.error-field :errors="$errors" name="description"></x-admin.error-field>
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
