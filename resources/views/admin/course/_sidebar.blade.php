<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

    <x-admin.image-picker :image="$course->featuredImage()"></x-admin.image-picker>

    @livewire('status-picker', ['status' => $course->status])


    <!--begin::Category & tags-->
    <div class="card card-flush py-4">
        <div class="card-header">
            <div class="card-title">
                <h2>جزئیات دوره</h2>
            </div>
        </div>
        <div class="card-body pt-0">

            <label class="form-label" for="level">سطح دوره</label>
            <select class="form-select" name="level" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="level">
                @foreach(App\Enums\CourseLevel::cases() as $status)
                    <option value="{{ $status->value }}" {{ $status === $course->level ? 'selected' : null }}>{{ $status->name() }}</option>
                @endforeach
            </select>

            <label class="form-label mt-10" for="categories" >دسته بندی ها</label>
            <select name="categories[]" id="categories" class="form-select" data-control="select2" data-placeholder="دسته بندی را انتخاب کنید" data-allow-clear="true" multiple="multiple">
                <option></option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, $course->categories->pluck('id')->toArray()) ? 'selected' : null }}>{{ $category->title }}</option>
                @endforeach
            </select>

            <div class="mb-10 mt-10 fv-row">
                <label class="required form-label" for="duration">مدت زمان کلی (ساعت)</label>
                <input type="text" name="duration" id="duration" class="form-control mb-2" placeholder="نام دوره" value="{{ old('duration', $course) }}" />
                <x-admin.error-field :errors="$errors" name="duration"></x-admin.error-field>
            </div>

            <label class="form-label mt-10" for="record_status" >وضعیت ضبط</label>
            <select name="record_status" id="record_status" class="form-select" data-control="select2" data-placeholder="وضعیت ضبط دوره  را انتخاب کنید">
                @foreach(\App\Enums\CourseRecordStatus::cases() as $record_status)
                    <option value="{{ $record_status->value }}" {{ $record_status === $course->record_status ? 'selected' : null }}>{{ $record_status->title() }}</option>
                @endforeach
            </select>

            <div class="mb-10 mt-10 fv-row">
                <label class="form-label" for="exp_points">امتیاز تجربه</label>
                <input type="text" name="exp_points" id="exp_points" class="form-control mb-2" placeholder="امتیاز تجربه" value="{{ old('exp_points', $course) }}" />
                <x-admin.error-field :errors="$errors" name="exp_points"></x-admin.error-field>
            </div>


            <!--end::Select2-->
            <!--begin::Description-->
            <div class="text-muted fs-7 mb-7">Add product to a category.</div>
            <!--end::Description-->
            <!--end::Input group-->
            <!--begin::Button-->
            <a href="../../demo9/dist/apps/ecommerce/catalog/add-category.html" class="btn btn-light-primary btn-sm mb-10">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                <span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
													<rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
												</svg>
											</span>
                <!--end::Svg Icon-->Create new category</a>
            <!--end::Button-->
            <!--begin::Input group-->
            <!--begin::Label-->
            <label class="form-label d-block">Tags</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input id="kt_ecommerce_add_product_tags" name="kt_ecommerce_add_product_tags" class="form-control mb-2" value="" />
            <!--end::Input-->
            <!--begin::Description-->
            <div class="text-muted fs-7">Add tags to a product.</div>
            <!--end::Description-->
            <!--end::Input group-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Category & tags-->
    <!--begin::Weekly sales-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Weekly Sales</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <span class="text-muted">No data available. Sales data will begin capturing once product has been published.</span>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Weekly sales-->
    <!--begin::Template settings-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Product Template</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Select store template-->
            <label for="kt_ecommerce_add_product_store_template" class="form-label">Select a product template</label>
            <!--end::Select store template-->
            <!--begin::Select2-->
            <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
                <option></option>
                <option value="default" selected="selected">Default template</option>
                <option value="electronics">Electronics</option>
                <option value="office">Office stationary</option>
                <option value="fashion">Fashion</option>
            </select>
            <!--end::Select2-->
            <!--begin::Description-->
            <div class="text-muted fs-7">Assign a template from your current theme to define how a single product is displayed.</div>
            <!--end::Description-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Template settings-->
</div>
