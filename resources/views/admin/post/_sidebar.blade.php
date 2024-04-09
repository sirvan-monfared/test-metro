<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

    <x-admin.image-picker :image="$post->featuredImage()"></x-admin.image-picker>

    @livewire('status-picker', ['status' => $post->status])


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
