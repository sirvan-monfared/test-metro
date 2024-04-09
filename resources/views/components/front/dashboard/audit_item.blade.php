@props(['item'])

@php
    if ($item->type === LevelUp\Experience\Enums\AuditType::Add) {
        $color = 'green-600';
        $icon = 'plus';
        $pointsSymbol = '+';
    }
    if ($item->type === LevelUp\Experience\Enums\AuditType::Remove) {
        $color = 'rose-500';
        $icon = 'minus';
        $pointsSymbol = '-';
    }
    if ($item->type === LevelUp\Experience\Enums\AuditType::LevelUp) {
        $color = 'blue-500';
        $icon = 'level-up';
        $pointsSymbol = null;
    }
    if ($item->reason === \App\Enums\ExperienceReason::ACHIEVEMENT->value) {
        $icon = 'trophy';
    }
@endphp

<li class="lg:flex items-center justify-between gap-2 space-y-4 lg:space-y-0 bg-white rounded-sm pl-5 pr-2 py-2 shadow-sm border border-gray-200 border-r-4 border-r-{{ $color }}">

    <div class="flex items-center gap-4">
        <div class="w-6 h-6 rounded-sm flex items-center justify-center text-{{ $color }}">
            <x-ui.icon icon="{{ $icon }}"></x-ui.icon>
        </div>
        @if($item->type === LevelUp\Experience\Enums\AuditType::LevelUp)
            <p class="flex items-center gap-1">
                <span>افزایش سطح کاربری به</span>
                <span>{{ $item->level_to }}</span>
            </p>
        @else
            {{ $item->description }}
        @endif
    </div>

    <div class="flex items-center justify-center gap-6">
        <p class="border-l pl-6 border-dashed border-gray-300">{{ $item->created_at->toJalali('Y/m/d')}}</p>
        <p class="flex items-center gap-1 w-24">
            @if($pointsSymbol)
                <span>{{ $pointsSymbol }}</span>
                <span>{{ $item->points }} </span>
                <span>امتیاز</span>
            @endif
        </p>
    </div>

</li>
