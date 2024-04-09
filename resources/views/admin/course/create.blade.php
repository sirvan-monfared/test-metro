@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-xxl" id="kt_content_container">

            <!--begin::Form-->
            <form method="POST" action="{{ route('admin.course.store') }}" enctype="multipart/form-data" class="form d-flex flex-column flex-lg-row">
                @method('POST')
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
                                            <input type="text" name="title" id="title" class="form-control mb-2" placeholder="نام دوره" value="{{ old('title') }}" />
                                            <x-admin.error-field :errors="$errors" name="title"></x-admin.error-field>
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <label class="form-label" for="alter_name"> نام نمایشی در صفحه دوره</label>
                                            <input type="text" name="alter_name" id="alter_name" class="form-control mb-2" placeholder="نام دوره" value="{{ old('alter_name') }}" />
                                            <x-admin.error-field :errors="$errors" name="alter_name"></x-admin.error-field>
                                        </div>
                                        <div>
                                            <label class="form-label" for="ckeditor">توضیحات</label>
                                            <textarea name="description" id="ckeditor" class="ckeditor">{{ old('description') }}</textarea>
                                            <x-admin.error-field :errors="$errors" name="description"></x-admin.error-field>
                                        </div>
                                        <div>
                                            <label class="form-label" for="short_description">توضیحات کوتاه</label>
                                            <textarea name="short_description" id="short_description" class="ckeditor">{{ old('short_description') }}</textarea>
                                            <x-admin.error-field :errors="$errors" name="short_description"></x-admin.error-field>
                                        </div>
                                        <div  class="mb-10 fv-row">
                                            <label class="form-label" for="goals">چیزهایی که در این دوره یاد میگیری</label>
                                            <textarea name="goals" id="goals" class="form-control" rows="10">{{ old('goals') }}</textarea>
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
                                            <!--begin::Dropzone-->
                                            <div class="dropzone" id="kt_ecommerce_add_product_media">
                                                <div class="dz-message needsclick">
                                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                    <div class="ms-4 text-start">
                                                        <h3 class="fs-5 fw-bolder text-gray-900 mb-1">فایل ها را اینجا بکشید یا برای آپلود کلیک کنید</h3>
                                                        <span class="fs-7 fw-bold text-gray-400">میتوانید بیش از 10 فایل آپلود کنید</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Dropzone-->
                                        </div>
                                    </div>
                                    <!--end::Card header-->
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
                                                <input type="text" name="project_link" id="project_link" class="form-control mb-2" placeholder="لینک پروژه ها" value="{{ old('project_link') }}" />
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
                                        <discount-picker></discount-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Tab pane-->

                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::Inventory-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">

                                            <h2>Inventory</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">


                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Inventory-->
                                <!--begin::Variations-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Variations</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                            <!--begin::Label-->
                                            <label class="form-label">Add Product Variations</label>
                                            <!--end::Label-->
                                            <!--begin::Repeater-->
                                            <div id="kt_ecommerce_add_product_options">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3">
                                                        <div data-repeater-item="" class="form-group d-flex flex-wrap gap-5">
                                                            <!--begin::Select2-->
                                                            <div class="w-100 w-md-200px">
                                                                <select class="form-select" name="product_option" data-placeholder="Select a variation" data-kt-ecommerce-catalog-add-product="product_option">
                                                                    <option></option>
                                                                    <option value="color">Color</option>
                                                                    <option value="size">Size</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="style">Style</option>
                                                                </select>
                                                            </div>
                                                            <!--end::Select2-->
                                                            <!--begin::Input-->
                                                            <input type="text" class="form-control mw-100 w-200px" name="product_option_value" placeholder="Variation" />
                                                            <!--end::Input-->
                                                            <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                                <span class="svg-icon svg-icon-2">
																					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																						<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="black" />
																						<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="black" />
																					</svg>
																				</span>
                                                                <!--end::Svg Icon-->
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Form group-->
                                                <!--begin::Form group-->
                                                <div class="form-group mt-5">
                                                    <button type="button" data-repeater-create="" class="btn btn-sm btn-light-primary">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                        <span class="svg-icon svg-icon-2">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
																			<rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
																		</svg>
																	</span>
                                                        <!--end::Svg Icon-->Add another variation</button>
                                                </div>
                                                <!--end::Form group-->
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Variations-->
                                <!--begin::Shipping-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Shipping</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Input-->
                                            <div class="form-check form-check-custom form-check-solid mb-2">
                                                <input class="form-check-input" type="checkbox" id="kt_ecommerce_add_product_shipping_checkbox" value="1" />
                                                <label class="form-check-label">This is a physical product</label>
                                            </div>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">Set if the product is a physical or digital item. Physical products may require shipping.</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Shipping form-->
                                        <div id="kt_ecommerce_add_product_shipping" class="d-none mt-10">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">Weight</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input type="text" name="weight" class="form-control mb-2" placeholder="Product weight" value="" />
                                                <!--end::Editor-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set a product weight in kilograms (kg).</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">Dimension</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                                                    <input type="number" name="width" class="form-control mb-2" placeholder="Width (w)" value="" />
                                                    <input type="number" name="height" class="form-control mb-2" placeholder="Height (h)" value="" />
                                                    <input type="number" name="length" class="form-control mb-2" placeholder="Lengtn (l)" value="" />
                                                </div>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Enter the product dimensions in centimeters (cm).</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Shipping form-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Shipping-->

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
                                            <input type="text" class="form-control mb-2" name="seo__title" id="seo__title" placeholder="تایتل" value="{{ old('seo__title') }}"/>
                                            <div class="text-muted fs-7">تایتل سئو را وارد کنید</div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label" for="seo__description">تگ description</label>
                                            <textarea id="seo__description" name="seo__description" class="form-control mb-2">{{ old('seo__description') }}</textarea>
                                            <div class="text-muted fs-7">توضیحات تگ description را وارد کنید</div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label" for="seo__keywords">کلمات کلیدی</label>
                                            <input id="seo__keywords" name="seo__keywords" class="form-control mb-2" value="{{ old('seo__keywords') }}" />
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
                                        <faq-builder :items="[]"></faq-builder>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab content-->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.course.index') }}" class="btn btn-light me-5">انصراف</a>

                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">ذخیره</span>
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
        startCKEditor('.ckeditor');
        startCKEditor('#short_description');
    </script>
@endsection
