<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10 me-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <div class="col-md-6 fv-row">
                        <label id="course_id" class="required fs-6 fw-bold mb-2">دوره</label>
                        <x-admin.course-selector :selected="$exercise->course->id" :required="true" class="w-400px"></x-admin.course-selector>
                    </div>
                </div>
            </div>


            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="title">عنوان تمرین</label>
                    <input type="text" name="title" id="title" class="form-control mb-2" placeholder="مبلغ پرداخت شده" value="{{ $exercise->title }}" />
                    <x-admin.error-field :errors="$errors" name="title"></x-admin.error-field>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="description">توضیحات</label>
                    <textarea type="text" name="description" id="description" class="form-control mb-2" rows="5">{{ $exercise->description }}</textarea>
                    <x-admin.error-field :errors="$errors" name="description"></x-admin.error-field>
                </div>
            </div>

            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="form-label" for="link">لینک دوره</label>
                    <input type="text" name="link" id="link" class="form-control mb-2" placeholder="لینک تمرین دوره" value="{{ $exercise->link }}" />
                    <x-admin.error-field :errors="$errors" name="link"></x-admin.error-field>
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
