@if (!$showRealLinks)
    @if ($lesson->isPreview() && $lesson->videos->count() > 0)
        <a href="{{ $lesson->videos->first()->path }}"
            class="flex items-center justify-center gap-1 bg-emerald-600 rounded-md text-white py-1 px-2 text-xs hover:bg-gray-700">

            <x-ui.icon icon="lock-open" class="stroke-white !w-4 !h-4"></x-ui.icon>
            <span class="font-medium"> دانلود ویدئو </span>
        </a>
    @else
        <x-ui.icon icon="lock"></x-ui.icon>
    @endif
@endif


@if ($showRealLinks && $course->ownedByCurrentUser())
    @if ($lesson->archives->count() > 0)
        <a href="{{ $lesson->archives->first()->path }}"
            class="flex items-center gap-1 text-blue-500 border-b border-transparent hover:border-dashed hover:border-current">
            <x-ui.icon icon="download-zip"></x-ui.icon>دانلود فایلهای این درس
        </a>
    @endif

    @if ($lesson->videos->count() > 0)
        <a href="{{ $lesson->videos->first()->path }}" title="دانلود ویدئو"
            class="bg-blue-500 border-b border-transparent flex gap-1 hover:border-b hover:border-current hover:border-dashed items-center px-2 py-1 rounded-md text-white text-xs">
            <x-ui.icon icon="download" class="!w-5 !h-5"></x-ui.icon>
            <span class="hidden md:block">دانلود ویدئو</span>
        </a>
    @endif

    @if ($lesson->links->count() > 0)
        <a href="{{ $lesson->links->first()->path }}" target="_blank"
            class="flex items-center gap-1 text-blue-500 border-b border-transparent hover:border-b hover:border-dashed hover:border-current">
            <x-ui.icon icon="code"></x-ui.icon>
        </a>
    @endif
@endif
@if ($showRealLinks && $course->ownedByCurrentUser() && $lesson->documents->count() > 0)
    <a href="{{ $lesson->documents->first()->path }}"  title="دانلود فایل" target="_blank" class="flex items-center gap-1 text-blue-500 border-b border-transparent hover:border-b hover:border-dashed hover:border-current">
        <x-ui.icon icon="pdf-download"></x-ui.icon>
    </a>
@endif
