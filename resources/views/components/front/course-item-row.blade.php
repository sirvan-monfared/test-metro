@props(['course'])

<a href="{{ route('dashboard.course', $course) }}"
   class="bg-white rounded-md shadow-sm border border-gray-200 p-1 md:p-2.5 relative flex flex-row gap-2 transition-all duration-300 hover:scale-105 hover:shadow-md">
    <div class="block w-2/5 md:w-1/5 ">
        <img class="rounded-md w-full h-full" src="{{ $course->featuredImage() }}" alt="{{ $course->title }}">
    </div>
    <div class="relative mt-3 text-neutral-800 flex flex-col justify-between md:px-4 w-3/5 md:w-4/5 md:mt-0">
        <div class="pl-8">
            <h4 href="{{ route('dashboard.course', $course) }}"
                class="block text-base md:text-lg font-medium truncate">{{ $course->title }}</h4>
        </div>

        <div class="flex justify-between items-end mt-5 min-h-[2.5rem] flex-1">
            <p class="flex items-center gap-1 text-gray-500">
                <x-ui.icon icon="clock" class="!w-4 !h-4"></x-ui.icon>
                <span class="text-sm">مدت : {{ $course->duration }} ساعت</span>
            </p>
        </div>
    </div>
</a>
