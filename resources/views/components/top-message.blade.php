@if ($show)
    <div class="bg-rose-500 font-medium text-white py-2 text-sm md:text-md text-center">
        @if ($link)
            <a href="{{ $link }}">{{ $text }}</a>
        @else
            <p>{{ $text }}</p>
        @endif
    </div>
@endif
