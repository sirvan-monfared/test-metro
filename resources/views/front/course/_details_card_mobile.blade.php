<div class="bg-white shadow-md rounded-md p-5 border border-gray-200 flex flex-col gap-8">

    <ul class="grid grid-cols-1 gap-3 sm:grid-cols-2 order-2 sm:order-1">
        <li class="flex items-center gap-2 text-lg">
            <x-ui.icon icon="clock"></x-ui.icon>
            <span> {{ $course->duration }} ساعت آموزش ویدیویی</span>
        </li>
        @if ($course->students_count > 50)
        <li class="flex items-center gap-2 text-lg">
            <x-ui.icon icon="students"></x-ui.icon>
            <span>تعداد دانشجو: {{ number_format(211 + $course->students_count) }}</span>
        </li>
        @endif
        <li class="flex items-center gap-2 text-lg">
            <x-ui.icon icon="support"></x-ui.icon>
            <span>پشتیبانی نامحدود و دائمی </span>
        </li>
        <li class="flex items-center gap-2 text-lg">
            <x-ui.icon icon="meeting"></x-ui.icon>
            <span>جلسات پرسش و پاسخ هفتگی</span>
        </li>
        <li class="flex items-center gap-4">
{{--            <div class="flex items-center gap-1 bg-gray-100 text-gray-600 px-2 py-1 rounded-sm text-xs shadow-sm">--}}
{{--                <x-ui.icon icon="clock" class="!w-4 !h-4"></x-ui.icon>--}}
{{--                <span>تاریخ انتشار: {{ $course->created_at->toJalali('Y/m/d') }}</span>--}}
{{--            </div>--}}
            <div class="flex items-center gap-1 bg-gray-100 text-gray-600 px-2 py-1 rounded-sm text-xs shadow-sm">
                <x-ui.icon icon="notification" class="!w-4 !h-4"></x-ui.icon>
                <span>آخرین بروزرسانی: {{ now()->toJalali('Y/m/d') }}</span>
            </div>
        </li>
    </ul>

    <div class="order-1">
        <div class="text-2xl text-black font-bold text-center">
            {!! $course->showPrice(bigFontSize: true) !!}
        </div>
        <x-front.add-to-cart-button :course="$course" :showPrice="false" class="w-full mt-3 py-3 justify-center !text-lg"></x-front.add-to-cart-button>
    </div>
</div>
