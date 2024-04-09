<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

    @livewire('status-picker', ['status' => $podcast->status])

    <div class="card card-flush py-4">
        <div class="card-header">
            <div class="card-title">
                <h2>جزئیات پادکست</h2>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="mt-10 fv-row">
                <label class="required form-label" for="duration">مدت زمان  (دقیقه)</label>
                <input type="text" name="duration" id="duration" class="form-control mb-2" value="{{ old('duration', $podcast) }}" />
                <x-admin.error-field :errors="$errors" name="duration"></x-admin.error-field>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="mb-10 mt-10 fv-row">
                <label class="form-label" for="episode">شماره اپیزود</label>
                <input type="text" name="episode" id="episode" class="form-control mb-2" value="{{ old('episode', $podcast) }}" />
                <x-admin.error-field :errors="$errors" name="episode"></x-admin.error-field>
            </div>
        </div>

        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2> برچسب ها</h2>
                </div>
            </div>
    
            <div class="card-body text-center pt-0">
                <div class="mb-10 fv-row">
                    <tags-input :tags="{{ $tags }}"></tags-input>
                </div>
            </div>
        </div>
    </div>

</div>

