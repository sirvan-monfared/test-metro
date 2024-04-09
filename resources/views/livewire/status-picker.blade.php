<div class="card card-flush py-4">
    <div class="card-header px-0">
        <div class="card-title">
            <h2>{{ $title }}</h2>
        </div>
        <div class="card-toolbar">
            <div class="rounded-circle bg-{{ $statusEnumClass::from($status)->color() }} w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
        </div>
    </div>
    <div class="card-body pt-0 px-0">
        <select class="form-select mb-2" wire:model="status" name="status" >
            @foreach($statusEnumClass::cases() as $status)
                <option value="{{ $status->value }}">{{ $status->name() }}</option>
            @endforeach
        </select>

        <div class="text-muted fs-7">{{ $title }} را انتخاب کنید</div>

    </div>
</div>
