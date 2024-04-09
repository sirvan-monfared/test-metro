<div class="px-5 lg:px-0">
    <div class="text-xl text-black font-bold flex items-center justify-between">
        <div class="flex items-center gap-3">
            <x-ui.icon icon="star" class="fill-amber-500"></x-ui.icon>
            <span> {{ $average_ratings }} </span>
            <span> | </span>
            <span> {{ $comments_count }} دیدگاه</span>
        </div>

        <div class="flex items-center gap-3">
            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class=" w-6 h-6" id="swiper-slide-prev">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class=" w-6 h-6"  id="swiper-slide-next">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg> --}}
        </div>
    </div>

    @if ($canReviewOnCourse)
        <blog-comments :can-comment="true" count="{{ $comments_count }}" rating="{{ $average_ratings }}"
            type="review" logged="{{ auth()->check() }}" :enrolled="true" username="{{ auth()->user()?->name }}"
            :id="{{ $course->id }}" endpoint="{{ route('api.course.comment.index', [$course, 'limit' => 4]) }}">
        </blog-comments>
    @else
        @if ($isEnrolled)
            <blog-comments :can-comment="false" count="{{ $comments_count }}" rating="{{ $average_ratings }}"
                type="review" logged="{{ auth()->check() }}" :enrolled="true"
                username="{{ auth()->user()?->name }}" :id="{{ $course->id }}"
                endpoint="{{ route('api.course.comment.index', [$course, 'limit' => 4]) }}"></blog-comments>
        @else
            <blog-comments :can-comment="false" count="{{ $comments_count }}" rating="{{ $average_ratings }}"
                type="review" logged="{{ auth()->check() }}" :enrolled="false"
                username="{{ auth()->user()?->name }}" :id="{{ $course->id }}"
                endpoint="{{ route('api.course.comment.index', [$course, 'limit' => 4]) }}"></blog-comments>
        @endif

    @endif


</div>
