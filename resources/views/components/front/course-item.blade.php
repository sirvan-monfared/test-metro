@php
    $course_link = $alreadyBought ? route('dashboard.course', $course) : $course->viewLink();
@endphp


<article class="bg-white shadow-md shadow-gray-300 rounded-md flex flex-col p-3">
    <a href="{{ $course_link }}">
        <img src="{{ $course->featuredImage() }}" class="rounded-md" alt="{{ $course->title }}" loading="lazy">
    </a>

    <a href="{{ $course_link }}" class="font-medium text-xl mt-4">{{ $course->title }}</a>

    <div class="mt-2 flex items-center justify-between">

        <div class="text-gray-400 flex items-center gap-1 py-1">
            <x-ui.icon icon="clock" class="!w-5 !h-5"></x-ui.icon>
            <span class="text-sm">مدت: {{ $course->duration }} ساعت</span>
        </div>

        @if ($course->record_status->isStillRecording())
            <x-front.course-record-status :course="$course">
                <span class="text-xxs font-medium">{{ $course->record_status->title() }}</span>
            </x-front.course-record-status>
        @endif
    </div>

    @if (!$alreadyBought)
        <a href="{{ $course_link }}" class="text-blue-500 flex items-center gap-2 mt-4">
            <span class="font-medium text-sm hover:text-blue-700">مشاهده اطلاعات دوره</span>
            <x-ui.icon icon="arrow-left"></x-ui.icon>
        </a>

        <div class="flex items-center justify-between mt-4">
            <x-front.add-to-cart-button :course="$course"></x-front.add-to-cart-button>
        </div>
    @else
        <a href="{{ $course_link }}"
            class="bg-blue-500 text-white flex items-center justify-center gap-2 mt-8 p-4 w-full rounded-md shadow-md">
            <x-ui.icon icon="eye"></x-ui.icon>
            <span class="font-medium text-lg">مشاهده محتوای دوره </span>
        </a>
    @endif

</article>
