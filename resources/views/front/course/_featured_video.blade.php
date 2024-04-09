<div class="flex items-center justify-center relative">
    <img class="w-full" src="{{ $course->featuredImage() }}"
        alt="{{ $course->alter_name ?: $course->title }}">
        
    @if ($course->hasPreviewVideo())
        <open-video-button video-url="{{ $course->preview_video }}"></open-video-button>
    @endif
</div>