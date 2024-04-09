@include('admin.podcast._sidebar')

<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">عمومی</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">پیشرفته</a>
        </li>
    </ul>

    <div class="tab-content">
        <!--begin::Tab pane-->
        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="card card-flush py-4">

                    @include('admin.flash')

                    <div class="card-header">
                        <div class="card-title">
                            <h2>عمومی</h2>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <div class="mb-10 fv-row">
                            <label class="required form-label" for="title">عنوان</label>
                            <input type="text" name="title" id="title" class="form-control mb-2" placeholder="عنوان" value="{{ old('title', $podcast) }}" />
                            <x-admin.error-field :errors="$errors" name="title"></x-admin.error-field>
                        </div>
                        <div class="mb-10 fv-row">
                            <label class="form-label" for="slug">نامک</label>
                            <input type="text" name="slug" id="slug" class="form-control mb-2" placeholder="نامک" value="{{ old('slug', $podcast) }}" />
                            <x-admin.error-field :errors="$errors" name="slug"></x-admin.error-field>
                        </div>
                        <div>
                            <label class="form-label" for="description">متن کامل</label>
                            <textarea name="description" id="description" >{{ old('description', $podcast) }}</textarea>
                            <x-admin.error-field :errors="$errors" name="description"></x-admin.error-field>
                        </div>
                    </div>
                </div>

                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2> فایل ها </h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="fv-row mb-2">
                            <div class="mb-10 fv-row">
                                <label class="form-label required" for="path">آدرس فایل پادکست</label>
                                <input type="text" name="path" id="path" class="form-control mb-2" value="{{ old('path', $podcast) }}" />
                                <x-admin.error-field :errors="$errors" name="path"></x-admin.error-field>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Tab pane-->

        <!--begin::Tab pane-->
        <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
            <div class="d-flex flex-column gap-7 gap-lg-10">

                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>تنظیمات سئو</h2>
                        </div>
                    </div>
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="mb-10">
                            <label class="form-label" for="seo__title">تگ title</label>
                            <input type="text" class="form-control mb-2" name="seo__title" id="seo__title" placeholder="تایتل" value="{{ old('seo__title', $podcast->getSeoTitleProperty()) }}"/>
                            <div class="text-muted fs-7">تایتل سئو را وارد کنید</div>
                        </div>
                        <div class="mb-10">
                            <label class="form-label" for="seo__description">تگ description</label>
                            <textarea id="seo__description" name="seo__description" class="form-control mb-2">{{ old('seo__description', $podcast->getSeoDescriptionProperty()) }}</textarea>
                            <div class="text-muted fs-7">توضیحات تگ description را وارد کنید</div>
                        </div>
                        <div>
                            <label class="form-label" for="seo__keywords">کلمات کلیدی</label>
                            <input id="seo__keywords" name="seo__keywords" class="form-control mb-2" value="{{ old('seo__keywords', $podcast->getSeoKeywordsProperty()) }}" />
                            <div class="text-muted fs-7"> کلمات کلیدی keywords را با استفاده از
                                <code>,</code> از هم جدا کنید</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end::Tab pane-->
    </div>
    <!--end::Tab content-->
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.post.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">انصراف</a>
        <button type="submit" class="btn btn-primary">
            <span class="indicator-label">ذخیره</span>
        </button>
    </div>
</div>
