@props(['achievement'])

<li class="relative" x-data="{show: false}">
    <img
        x-on:mouseover="show=true"
        x-on:mouseleave="show=false"
        @class([
            'cursor-pointer mb-4 transition-all duration-500 opacity-50 mix-blend-luminosity bg-white rounded-full drop-shadow-lg hover:mix-blend-normal hover:opacity-100 ',
            '!mix-blend-normal !opacity-100' => auth()->user()->hasAchievement($achievement)]
        )
        src="{{ asset($achievement->image) }}"
        width="64" height="64"
        alt="{{ $achievement->description }}"
        title="{{ $achievement->description }}"
    >
    <div class="absolute flex flex-col  gap-2 left-1/2 -translate-x-[50%] bg-teal-600 text-white shadow-md rounded-md p-2 text-sm text-center w-[200px]"
        x-cloak
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        <p class="font-medium text-sm">{{ $achievement->description }}</p>
        <p class="text-teal-100 text-base">{{ $achievement->xp_points }} امتیاز</p>

        @if(\App\Services\Achievement\AchievementService::isProgressive($achievement))
              <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="bg-amber-400 text-sm font-medium text-amber-900 text-center p-0.5 leading-none rounded-full"
                         style="width: {{ auth()->user()->achievementProgression($achievement) }}%"> {{ auth()->user()->achievementProgression($achievement) }}%</div>
              </div>
        @endif

    </div>
</li>
