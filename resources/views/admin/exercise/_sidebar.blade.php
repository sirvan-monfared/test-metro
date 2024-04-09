<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-500px mb-7 me-lg-10">

    <!--begin::Category & tags-->
    <div class="card card-flush py-4">
        <div class="card-header">
            <div class="card-title">
                <h2>وضعیت تمرین</h2>
            </div>
        </div>
        <div class="card-body pt-0">

            @livewire('status-picker', [
                'status' => $exercise->status,
                'statusEnumClass' => App\Enums\ExerciseStatus::class,
                'title' => 'وضعیت'
            ])

            <div class="fv-row mb-10 fv-plugins-icon-container">
                <label class="form-check form-check-custom form-check-solid form-check-inline">
                    <input class="form-check-input" type="checkbox" name="public" @checked($exercise->public)>
                    <span class="form-check-label fw-bold text-gray-700 fs-6"> قابل مشاهده برای دیگران؟ </span>
                </label>
                <div class="fv-plugins-message-container invalid-feedback"></div>
            </div>

        </div>
    </div>

    <div class="card card-flush py-4">
        <div class="card-header">
            <div class="card-title">
                <h2>توضیحات و امتیاز شما به تمرین</h2>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="mb-10 fv-row">
                <label class="form-label" for="review">توضیحات شما</label>
                <textarea name="review" id="review" class="ckeditor">{{ old('review', $exercise) }}</textarea>
                <x-admin.error-field :errors="$errors" name="review"></x-admin.error-field>
            </div>

            <label class="form-label fw-bolder" for="rating">امتیاز شما</label>
            <select class="form-select" name="rating" data-control="select2" data-hide-search="true"
                    data-placeholder="Select an option" id="rating">
                @for($i = 1; $i <= 5; $i++ )
                    <option value="{{ $i }}" @selected((int) $exercise->rating === $i)>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

</div>
