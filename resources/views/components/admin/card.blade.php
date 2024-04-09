<div class="card card-flush py-4">
    @if(isset($title))
        <div class="card-header">
            <div class="card-title">
                <h2>{{ $title }}</h2>
            </div>
        </div>
    @endif
    <div class="card-body pt-0">
        <div class="fv-row mb-2">
            {{ $slot }}
        </div>
    </div>
</div>
