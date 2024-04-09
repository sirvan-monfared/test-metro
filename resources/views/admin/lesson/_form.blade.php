<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
    <x-admin.card>
        <section-picker :course-id="{{ $lesson->course_id }}" :section-id="{{ $lesson->section()?->id }}"></section-picker>
    </x-admin.card>
</div>

<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>
            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="title">عنوان درس</label>
                    <input type="text" name="title" id="title" class="form-control mb-2" placeholder="نام دوره" value="{{ old('title', $lesson) }}" />
                    <x-admin.error-field :errors="$errors" name="title"></x-admin.error-field>
                </div>
            </div>
            <div>
                <label class="form-label" for="ckeditor">توضیحات</label>
                <textarea name="description" id="ckeditor" class="ckeditor">{{ old('description', $lesson) }}</textarea>
                <x-admin.error-field :errors="$errors" name="description"></x-admin.error-field>
            </div>
            <div class="row fv-row mt-10">
                <div class="col-md-6">
                    <div class="d-flex flex-column mb-7 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                            <span class="required">مدت زمان</span>
                        </label>
                        <input type="text" name="duration" value="{{ old('duration', $lesson) }}" class="form-control"/>
                        <x-admin.error-field :errors="$errors" name="description"></x-admin.error-field>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="fs-6 fw-bold form-label">این درس را رایگان می کنید؟</label>
                    <label class="form-check form-switch form-check-custom">
                        <input class="form-check-input" name="is_free" type="checkbox" @if($lesson->isFree()) checked @endif/>
                        <span class="form-check-label fw-bold text-muted">رایگان کن!</span>
                    </label>
                </div>
            </div>
            <div class="d-flex flex-column mb-8">
                <label class="fs-6 fw-bold mb-2">توضیحات کوتاه</label>
                <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $lesson) }}</textarea>
            </div>
        </x-admin.card>

        <x-admin.card>
            <lesson-files :current-files="{{ $lesson->files }}"></lesson-files>
        </x-admin.card>
    </div>

    <div class="d-flex justify-content-end">
        <a href="../../demo9/dist/apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
            <span class="indicator-label">Save Changes</span>
            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</div>
