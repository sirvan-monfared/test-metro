@if ($course->hasPreviewVideo())
    <div class="course-video" id="preview-video">
        <h3 >پیش نمایش دوره {{ $course->title }}</h3>

        @if($course->hasAparatVideo())
            <div class="h_iframe-aparat_embed_frame">
                <span></span>
                <iframe loading="lazy" src="{{ apartIframeUrl($course->preview_video) }}" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
            </div>
        @else
            <video controls class="native-preview-video">
                <source src="{{ $course->preview_video }}" type="video/mp4">
                مرورگر شما از نمایش ویدئو پشتیبانی نمی کند
            </video>
        @endif
    </div>
@endif
