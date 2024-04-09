@extends('admin.layouts.main')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">


            @include('admin.flash')
            <form method="POST" action="{{ route('admin.comment.store') }}" class="form d-flex flex-column flex-lg-row">
                @csrf
                @method('POST')



                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <x-admin.card>

                            <h1 class="mt-5">افزودن دیدگاه</h1>


                            <div class="row mt-10">
                                <div class="mb-10 fv-row">
                                    <div class="col-md-6 fv-row">
                                        <label id="course_id" class="required fs-6 fw-bold mb-2">دوره</label>
                                        <select name="course_id" class="form-select"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="نام دوره">
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
                                        <label id="user_id" class="fs-6 fw-bold mb-2">کاربر</label>
                                        <user-select></user-select>
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-10">
                                <div class="mb-10 fv-row">
                                    <div class="col-md-6 fv-row">
                                        <label for="fname" class="fs-6 fw-bold mb-2">نام و نام خانوادگی (ف)</label>
                                        <input type="text" name="fname" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-10">
                                <div class="mb-10 fv-row">
                                    <div class="col-md-6 fv-row">
                                        <label id="rating" class="required fs-6 fw-bold mb-2">امتیاز  </label>
                                        <select name="rating" class="form-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-10">
                                <div class="mb-10 fv-row">
                                    <label class="form-label" for="body">متن دیدگاه</label>
                                    <textarea type="text" name="body" id="body" rows="10"
                                              class="form-control mb-2">{{ old('body') }}</textarea>
                                    <x-admin.error-field :errors="$errors" name="body"></x-admin.error-field>
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

            </form>
        </div>
    </div>
@endsection

