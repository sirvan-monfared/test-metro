<div class="flex items-center justify-between">
    <h3 class="text-xl lg:text-2xl text-black font-bold">آخرین تمرینات ارسالی شما</h3>
    <a href="{{ route('dashboard.course.exercise.create', $course) }}"
       class="bg-blue-500 text-white py-1 px-2 rounded-sm text-sm shadow-sm hover:opacity-70">ارسال تمرین</a>
</div>

<div class="flex flex-col mt-4 lg:mt-16 gap-4">
    @forelse ($exercises as $exercise)
        <a href="{{ route('dashboard.exercise.show', $exercise) }}">
            <x-front.card class="!p-5 hover:scale-105 hover:shadow-md transition-all duration-500">
                <div class="flex items-center justify-between truncate">
                    <div class="flex flex-col gap-2 truncate">
                        <h6 class="font-medium truncate">{{ $exercise->title }}</h6>
                        <p class="text-sm text-gray-600">{{ $exercise->created_at->toJalali('Y/m/d') }}</p>
                    </div>
                    <div class="{{ $exercise->status->cssClass() }} text-white text-sm rounded-md py-1 px-2">
                        {{ $exercise->status->name() }}
                    </div>
                </div>
            </x-front.card>
        </a>
    @empty
        <x-front.card class="!p-5">
            <div class="flex flex-col items-center justify-center gap-4">
                <x-ui.icon icon="exercise" class="!w-20 !h-20"></x-ui.icon>
                <h6 class="text-gray-800 text-lg font-semibold">هنوز هیچ تمرینی برای این دوره ارسال نکردی!</h6>
                <p>میدونستی با ارسال تمرین برای دوره ها، میتونی امتیازت رو زیاد کنی؟</p>
            </div>
        </x-front.card>
    @endforelse

    @if($exercises->count() > 0)
    {{-- <div class="text-center">--}}
    {{--     <a class="text-blue-500 border-dashed border-current hover:border-b " href="#">مشاهده همه تمرینات دوره</a>--}}
    {{-- </div>--}}
    @endif
</div>
