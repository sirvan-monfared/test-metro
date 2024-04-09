<section class="" x-data="accordion({{ $course->sections->pluck('id') }})">

    <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
        <h3 class="text-xl lg:text-2xl text-black font-bold">سرفصل های دوره</h3>

        @if ($course->record_status->isStillRecording())
            <x-front.course-record-status :course="$course">
                <span class="text-sm text-center">این دوره در حال ضبط می باشد و به مرور زمان تکمیل میشود</span>
            </x-front.course-record-status>
        @endif
    </div>
    <div class="mt-3 lg:mt-8 flex flex-col items-start md:items-center gap-5 md:flex-row md:justify-between">
        <p class="text-sm"> <span>{{ $course->lessons_count }} درس، </span>
            <span>{{ $course->duration }} ساعت آموزش</span>
        </p>
        <a href="#" class="font-bold text-blue-500 text-sm" x-on:click.prevent="openAll"
            x-text="allOpened ? 'بستن همه' : 'بازکردن همه بخش ها'"></a>
    </div>


    <!-- course content accordion -->
    <div class="mt-3 border border-gray-300">

        @foreach ($course->sections as $section)
            <div>
                <div class="border-b border-gray-300" x-on:click="clicked({{ $section->id }})">
                    <div
                        class="bg-gray-100 border-b border-gray-300 py-4 px-4 text-gray-700 flex items-center justify-between cursor-pointer">
                        <div class="flex items-center gap-3">
                            <x-ui.icon icon="presentation" class="shrink-0"></x-ui.icon>
                            <p class="text-xs lg:text-lg font-semibold">
                                {{ $section->title }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span
                                class="bg-neutral-300 text-neutral-700 rounded-full px-2 py-1 text-xxs lg:text-xs font-semibold">
                                {{ $section->lessons->count() }} جلسه
                            </span>
                            <x-ui.icon icon="caret-down" class="transition-all w-4 h-4 lg:w-6 lg:h-6"
                                x-bind:class="items[{{ $section->id }}] ? 'rotate-180' : ''"></x-ui.icon>
                        </div>
                    </div>
                </div>
                <div class="transition-all duration-500 overflow-hidden h-0 "
                    x-bind:class="items[{{ $section->id }}] ? 'h-auto' : ''">
                    @foreach ($section->lessons as $lesson)
                        <div class="flex items-center justify-between p-3 px-5 text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="text-gray-300 text-xl md:text-3xl w-8 text-start">{{ $loop->index + 1 }}</i>
                                <p class="text-sm md:text-base">{{ $lesson->title }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <span class="hidden md:block">{{ $lesson->duration }}
                                    دقیقه</span>
                                <div class="min-w-[6rem] flex justify-end gap-4">
                                    {{-- <x-ui.icon icon="lock" class="svg-20"></x-ui.icon> --}}
                                    <x-front.lesson-link :lesson="$lesson" :course="$course" :showRealLinks="$showRealLinks">
                                    </x-front.lesson-link>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endforeach

    </div>

</section>
