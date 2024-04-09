<div class="card card-xl-stretch mb-xl-8">
    @if(isset($title))
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder text-dark">{{ $title }}</span>
                <span class="text-muted mt-1 fw-bold fs-7">{{ $subtitle ?? null }}</span>
            </h3>
        </div>
    @endif
    <div class="card-body d-flex flex-column">
        {{ $slot }}
    </div>
</div>
