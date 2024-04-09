<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>
            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <div class="col-md-6 fv-row">
                        <label id="course_id" class="required fs-6 fw-bold mb-2">دوره</label>
                        <select name="course_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="نام دوره">
                            <option value="">انتخاب کنید</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <div class="col-md-6 fv-row">
                        <label id="course_id" class="required fs-6 fw-bold mb-2">کاربر</label>
                        <user-select></user-select>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="price">مبلغ پرداخت شده</label>
                    <input type="text" name="price" id="price" class="form-control mb-2" placeholder="مبلغ پرداخت شده" value="{{ old('price') }}" />
                    <x-admin.error-field :errors="$errors" name="price"></x-admin.error-field>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="form-label" for="description">توضیحات</label>
                    <textarea type="text" name="description" id="description" class="form-control mb-2">{{ old('description') }}</textarea>
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