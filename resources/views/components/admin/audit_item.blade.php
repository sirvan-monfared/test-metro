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
@endphp


<div class="border border-gray-300 border-dashed rounded min-w-150px py-3 px-4 me-6 mb-3">
    <div class="d-flex align-items-center">

        <div class="fs-2 fw-bolder">
            @if($pointsSymbol)
                <span>{{ $pointsSymbol }}</span>
                <span>{{ $item->points }} </span>
                <span>امتیاز</span>
            @endif
        </div>
    </div>
    <div class="fw-bold fs-6 text-gray-400 d-flex justify-content-between">
        @if($item->type === LevelUp\Experience\Enums\AuditType::LevelUp)
            <p class="flex items-center gap-1">
                <span>افزایش سطح کاربری به</span>
                <span>{{ $item->level_to }}</span>
            </p>
        @else
            <p>{{ $item->description }}</p>
        @endif

        <p>{{ $item->created_at->toJalali('Y/m/d')}}</p>
    </div>
</div>


