@if($errors?->has($name))
    <p class="text-sm text-rose-600">{{ $errors->first($name) }}</p>
@else
    {{ $slot }}
@endif
