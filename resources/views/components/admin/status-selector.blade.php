@props(['enumClass', 'selected', 'required'])

<div>
    <div class="mw-150px">
        <select name="status" data-placeholder="وضعیت" {{ $attributes->merge(['class' => 'form-select form-select-solid']) }}>
            @if(! isset($required) || ! $required)
                <option value="" >همه</option>
            @endif

            @foreach($statuses as $status)
                <option value="{{ $status->value }}" @selected($status->value == $selected)>{{ $status->name() }}</option>
            @endforeach
        </select>
    </div>
</div>
