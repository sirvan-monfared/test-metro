@if ($course->project_link)
    <x-front.card class="shadow-md hover:opacity-70">
        <a href="{{ $course->project_link }}" target="_blank" class="w-full h-full flex items-center gap-3">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
            </span>

            <span class="font-medium text-center text-sm leading-relaxed lg:text-base">برای مشاهده آنلاین پروژه اجرا شده
                در دوره، اینجا کلیک کنید</span>
        </a>
    </x-front.card>
@endif
