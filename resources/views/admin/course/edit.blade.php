@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">

            <!--begin::Form-->
            <form method="POST" action="{{ route('admin.course.update', $course) }}" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @method('PATCH')
                @csrf

                @include('admin.course._sidebar')

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">عمومی</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">پیشرفته</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#faqs">سوالات متداول</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>عمومی</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">

                                        @include('admin.flash')

                                        <div class="mb-10 fv-row">
                                            <label class="required form-label" for="title"> نام دوره</label>
                                            <input type="text" name="title" id="title" class="form-control mb-2" placeholder="نام دوره" value="{{ old('title', $course) }}" />
                                            <x-admin.error-field :errors="$errors" name="title"></x-admin.error-field>
                                        </div>
                                        @if($course->slug)
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label" for="title">نامک</label>
                                                <input type="text" name="slug" id="slug" class="form-control mb-2" placeholder="نامک" value="{{ old('slug', $course) }}" />
                                                <x-admin.error-field :errors="$errors" name="slug"></x-admin.error-field>
                                            </div>
                                        @endif
                                        <div class="mb-10 fv-row">
                                            <label class="form-label" for="alter_name"> نام نمایشی در صفحه دوره</label>
                                            <input type="text" name="alter_name" id="alter_name" class="form-control mb-2" placeholder="نام نمایشی در صفحه دوره" value="{{ old('alter_name', $course) }}" />
                                            <x-admin.error-field :errors="$errors" name="alter_name"></x-admin.error-field>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label" for="description">توضیحات</label>
                                            <textarea name="description" id="description" class="ckeditor">{{ old('description', $course) }}</textarea>
                                            <x-admin.error-field :errors="$errors" name="description"></x-admin.error-field>
                                        </div>

                                        <div class="mb-10 fv-row">
                                            <label class="form-label" for="short_description">توضیحات کوتاه</label>
                                            <textarea name="short_description" id="short_description" class="ckeditor">{{ old('short_description', $course) }}</textarea>
                                            <x-admin.error-field :errors="$errors" name="short_description"></x-admin.error-field>
                                        </div>

                                        <div class="mb-10 fv-row">
                                            <label class="form-label" for="goals">چیزهایی که در این دوره یاد میگیری</label>
                                            <textarea name="goals" id="goals" class="form-control" rows="10">{{ old('goals', $course) }}</textarea>
                                            <x-admin.error-field :errors="$errors" name="goals"></x-admin.error-field>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>ویدیوی پیش نمایش</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="fv-row mb-2">
                                            <div class="mb-10 fv-row">
                                                <label class="form-label" for="preview_video">آدرس ویدئو</label>
                                                <input type="text" name="preview_video" id="preview_video" class="form-control mb-2" placeholder="آدرس ویدئو" value="{{ old('preview_video', $course) }}" />
                                                <x-admin.error-field :errors="$errors" name="preview_video"></x-admin.error-field>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>لینک پروژه های دوره</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="fv-row mb-2">
                                            <div class="mb-10 fv-row">
                                                <label class="form-label" for="project_link">لینک پروژه ها </label>
                                                <input type="text" name="project_link" id="project_link" class="form-control mb-2" placeholder="لینک پروژه ها" value="{{ old('project_link', $course) }}" />
                                                <x-admin.error-field :errors="$errors" name="project_link"></x-admin.error-field>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>قیمت</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <discount-picker :price="{{ $course->price }}" :discount-type="{{ $course->discount_type->value }}" :discount-amount="{{ $course->discount_amount }}"></discount-picker>
                                    </div>
                                </div>
                                <!--end::Pricing-->
                            </div>
                        </div>
                        <!--end::Tab pane-->

                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">

                            <div class="d-flex flex-column gap-7 gap-lg-10">

                                <div class="card card-flush py-4">
                                    <div class="card-body pt-0">
                                        <lesson-builder :id="{{ $course->id }}"></lesson-builder>
                                    </div>
                                </div>

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
                                            <input type="text" class="form-control mb-2" name="seo__title" id="seo__title" placeholder="تایتل" value="{{ $course->seo['seo__title'] ?? null }}"/>
                                            <div class="text-muted fs-7">تایتل سئو را وارد کنید</div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label" for="seo__description">تگ description</label>
                                            <textarea id="seo__description" name="seo__description" class="form-control mb-2">{{ $course->seo['seo__description'] ?? null }}</textarea>
                                            <div class="text-muted fs-7">توضیحات تگ description را وارد کنید</div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label" for="seo__keywords">کلمات کلیدی</label>
                                            <input id="seo__keywords" name="seo__keywords" class="form-control mb-2" value="{{ $course->seo['seo__keywords'] ?? null }}" />
                                            <div class="text-muted fs-7"> کلمات کلیدی keywords را با استفاده از
                                                <code>,</code> از هم جدا کنید</div>
                                        </div>
                                        <div>
                                            <label class="form-label" for="seo__schema"> کد schema </label>
                                            <textarea id="seo__schema" name="seo__schema" class="form-control mb-2" rows="8">{{ $course->seo['seo__schema'] ?? null }}</textarea>
                                            <div class="text-muted fs-7">تگ schema را وارد کنید</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Tab pane-->

                        <div class="tab-pane fade" id="faqs" role="tab-panel">

                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>سوالات متداول</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <faq-builder :items="{{ json_encode($course->faqs) }}"></faq-builder>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.course.index') }}" class="btn btn-light me-5">انصراف</a>

                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره تغییرات</span>
                        </button>
                    </div>
                </div>
                <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('admin/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

    <script src="{{ asset('admin/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>
    <script src="{{ asset('admin/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('admin/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('admin/js/custom/utilities/modals/users-search.js') }}"></script>
    <script src="{{ asset('admin/plugins/custom/ckeditor5-custom/build/ckeditor.js') }}"></script>

    <script>
        startCKEditor('#description');
        startCKEditor('#short_description');
    </script>
@endsection
