<li class="justify-content-start mb-10">
    <div class="flex-column align-items-start">
        <div class="align-items-center mb-2">
            <div class="ms-3">
                <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">{{ $comment->user->id }}</a>
                <span class="text-muted fs-7 mb-1">{{ $comment->created_at->toJalali('Y/m/d') }}</span>
            </div>
        </div>
        <div class="p-5 rounded bg-light-info text-dark fw-semibold text-start" data-kt-element="message-text">{{ $comment->body }}</div>
    </div>

        @if($comment->children)
            <ul>
                @foreach($comment->children as $children)
                    @include('admin._comment', ['comment' => $children])
                @endforeach
            </ul>
        @endif
</li>
