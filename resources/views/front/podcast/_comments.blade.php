<div class="mt-8 px-5 lg:px-0">
    <div class="text-xl text-black font-bold flex items-center gap-3">
        <x-ui.icon icon="comment"></x-ui.icon>
        <span> 
            {{ $comments_count }} دیدگاه 
            <small class="text-sm"> 
                &nbsp <a href="#create-comment" class="text-blue-500 border-current hover:border-b hover:border-dashed">(ارسال دیدگاه) </a>
            </small>
        </span>
    </div>

    <div id="create-comment">
        <blog-comments logged="{{ auth()->check() }}" username="{{ auth()->user()?->name }}"
            :id="{{ $podcast->id }}" endpoint="{{ route('api.podcast.comment.index', $podcast) }}">
        </blog-comments>
    </div>
</div>