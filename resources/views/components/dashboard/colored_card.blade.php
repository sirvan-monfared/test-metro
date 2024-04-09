@props(['icon', 'title', 'amount'])
<div {{ $attributes->merge(['class' => 'p-3 shadow-md rounded-md']) }}>
    <div class="flex flex-col items-center gap-5">
        <div class="flex flex-col items-center gap-2">
            <x-ui.icon :icon="$icon" class="!w-10 !h-10"></x-ui.icon>
            <h4 class="text-lg font-semibold">{{ $title }}</h4>
        </div>
        <p class="font-semibold text-2xl">{{ $amount }}</p>
    </div>
</div>
