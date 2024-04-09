<li class="justify-content-start mb-5 comment-list-item" id="comment-{{ $comment->id }}">
    <div class="d-flex comment-item bg-light-info p-5 rounded">
        <div class="flex-column align-items-center mb-2">
            <div class="d-flex align-items-center mb-2">
                <div class="symbol symbol-35px symbol-circle">
                    <img loading="lazy" alt="Pic" src="{{ $comment->user->featuredImage() }}">
                </div>
                <div class="ms-3">
                    <a href="{{ route('admin.user.edit', $comment->user) }}" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1" target="_blank">{{ $comment->user?->name }}</a>
                    
                    
                </div>
            </div>
            <div class="text-dark fw-semibold text-start">{{ $comment->body }}</div>

            <p class="published-in">
                نوشته شده در {{ $comment->commentableTypeName() }} : 
                <a href="{{ $comment->commentable->commentViewLink() }}#comment-{{ $comment->id }}" target="_blank">
                    {{ $comment->commentable->title }}
                </a>
            </p>
        </div>

        <div class="comment-status d-flex flex-column">
            @livewire('comment-status', ['comment' => $comment])
            {{-- <span class="badge badge-{{ $comment->status->color() }}">{{ $comment->status->name() }}</span> --}}
            {{-- <comment-status :id={{ $comment->id }} :current-status="{{ $comment->status->value }}"></comment-status> --}}

            <span class="remove-comment">
                <delete-confirm action="{{ route('admin.comment.destroy', $comment) }}">
                    <button type="submit" class="icon-only"><i class="fa fa-trash text-danger"></i></button>  
                </delete-confirm>
            </span>
        </div>
    </div>

    @if($showChildren ?? false)
        <ul class="me-n5 pe-5 comments-list">
            @foreach ($comment->allChildren as $children)
                <x-admin.comment :comment="$children"></x-admin.comment>
            @endforeach
        </ul>
    @endif
    
</li>
