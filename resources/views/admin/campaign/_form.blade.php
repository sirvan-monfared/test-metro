<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 me-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="title">عنوان</label>
                    <input type="text" name="title" id="title" class="form-control mb-2" placeholder="عنوان" value="{{ $campaign->title }}" />
                    <x-admin.error-field :errors="$errors" name="title"></x-admin.error-field>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="slug">نامک</label>
                    <input type="text" name="slug" id="slug" class="form-control mb-2" placeholder="نامک" value="{{ $campaign->slug }}" />
                    <x-admin.error-field :errors="$errors" name="slug"></x-admin.error-field>
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
