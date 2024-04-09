@props(['route_name', 'title', 'icon'])
<a href="{{route($route_name)}}"
   @class([
       'flex items-center gap-3 px-5 py-4 text-gray-800 hover:bg-sky-100 hover:text-sky-400 text-base',
       'bg-sky-100 text-sky-400 hover:bg-sky-100' => request()->routeIs($route_name)
   ])>
    @if($slot->isNotEmpty())
        {{ $slot }}
    @else
        <div class="w-6 h-6">
            <x-ui.icon :icon="$icon" class="stroke-sky-500"></x-ui.icon>
        </div>
        <span class="font-medium">{{ $title }}</span>
    @endif
</a>
