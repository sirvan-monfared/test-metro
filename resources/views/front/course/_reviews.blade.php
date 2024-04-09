<div class="px-5 lg:px-0">
    <div class="text-xl text-black font-bold flex items-center gap-3">
        <x-ui.icon icon="star" class="fill-amber-500"></x-ui.icon>
        <span> {{ $average_ratings }} </span>
        <span> | </span>
        <span> {{ $comments_count }} دیدگاه</span>
    </div>

    @if ($canReviewOnCourse)
        <blog-comments :can-comment="true" count="{{ $comments_count }}" rating="{{ $average_ratings }}" type="review" logged="{{ auth()->check() }}" :enrolled="true"
            username="{{ auth()->user()?->name }}" :id="{{ $course->id }}"
            endpoint="{{ route('api.course.comment.index', [$course, 'limit' => 4]) }}"></blog-comments>
    @else
        @if($isEnrolled)
            <blog-comments :can-comment="false" count="{{ $comments_count }}" rating="{{ $average_ratings }}" type="review" logged="{{ auth()->check() }}"
                :enrolled="true" username="{{ auth()->user()?->name }}" :id="{{ $course->id }}"
                endpoint="{{ route('api.course.comment.index', [$course, 'limit' => 4]) }}"></blog-comments>
        @else
            <blog-comments :can-comment="false" count="{{ $comments_count }}" rating="{{ $average_ratings }}" type="review" logged="{{ auth()->check() }}"
                :enrolled="false" username="{{ auth()->user()?->name }}" :id="{{ $course->id }}"
                endpoint="{{ route('api.course.comment.index', [$course, 'limit' => 4]) }}"></blog-comments>
        @endif

    @endif

</div>


{{-- <div class="student_reviews" id="comments">
    <div class="review_right">
        <div class="review_right_heading">
            <h3>نظر دانشجوهای دوره</h3>
            <small><a href="#create-comment">ارسال دیدگاه</a></small>
        </div>
    </div>
    
</div> --}}
