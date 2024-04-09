@props(['items'])


<nav aria-label="breadcrumb">

    <ol {{ $attributes->merge(['class' => 'text-sm font-medium flex items-center gap-2']) }}>
        @foreach ($items as $breadcrumb_item)
            <x-front.breadcrumb-item :last="$loop->last" class="{{ $loop->last ? 'truncate' : 'null' }}">
                @if (!$loop->last)
                    <a href="{{ $breadcrumb_item['item'] }}" class="font-medium border-current hover:border-b hover:border-dashed hover:text-blue-400 truncate">{{ $breadcrumb_item['name'] }}</a>
                @else
                    <span class="font-normal truncate">{{ $breadcrumb_item['name'] }}</span>
                @endif
            </x-front.breadcrumb-item>
        @endforeach
    </ol>

</nav>
