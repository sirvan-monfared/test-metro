@if ($course->goals)
    <div class="p-5 md:p-10 md:mt-10 border border-dashed border-gray-400">
        <h2 class="text-xl md:text-xl lg:text-2xl font-bold">در این دوره چی یاد می
            گیری؟
        </h2>
        <ul class="mt-5 md:mt-10 grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 md:gap-y-7">
            @foreach ($course->allGoals() as $goal)
                <li class="text-base  flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 shrink-0">
                        <path fill-rule="evenodd"
                            d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ $goal }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
