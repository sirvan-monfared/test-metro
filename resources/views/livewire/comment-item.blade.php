<li class="justify-content-start mb-5 comment-list-item" id="comment-{{ $comment->id }}">
    <div class="d-flex flex-column p-5 rounded {{ $bgClass }}">
        <div class="d-flex comment-item">
            <div class="flex-column align-items-center mb-2">
                <div class="d-flex align-items-center mb-2">
                    <div class="symbol symbol-35px symbol-circle">
                        <img alt="Pic" src="{{ $comment->user->featuredImage() }}">
                    </div>
                    <div class="ms-3">
                        <a href="{{ route('admin.user.edit', $comment->user) }}" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1" target="_blank">{{ $comment->user?->name }}</a>

                        @if($comment->isReview())
                            <div class="review-info d-flex">
                                <star-rating :increment="0.01" :rating="{{ $comment->rating }}" :rounded-corners="true" :rtl="true" :read-only="true" :show-rating="false" :star-size="20"/>
                                <p class="text-muted fs-7">{{ $comment->created_at->toJalali()->formatDifference() }}</p>
                            </div>
                        @else
                            <p class="text-muted fs-7 mb-1">{{ $comment->created_at->toJalali()->formatDifference() }}</p>
                        @endif
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
                <span class="remove-comment">
                    <delete-confirm action="{{ route('admin.comment.destroy', $comment) }}">
                        <button type="submit" class="icon-only"><i class="fa fa-trash text-danger"></i></button>
                    </delete-confirm>
                </span>
            </div>
            
        </div>
        @if($showReply && ! $comment->isReview())
            <div class="d-block mt-2">
                @if(session()->has('success'))
                    <p class="badge badge-success d-block text-start">
                        {{ session('success') }}
                    </p>
                @endif
                @if(! $replying)
                    <a href="#" wire:click.prevent="$set('replying', true)">پاسخ</a>
                @else
                    <a href="#" wire:click.prevent="$set('replying', false)">بیخیال</a>
                    <form wire:submit.prevent='createReply'>
                        <textarea wire:model.defer="reply" class="form-control mt-4 @error('reply') border-danger @enderror" rows="5">
                        </textarea>
                        @error('reply') <p class="text-danger">{{ $message }}</p> @enderror

                        <div class="text-end mt-6">
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </form>
                @endif
            </div>
        @endif
    </div>

    

    @if($showChildren)
        <ul class="me-n5 pe-5 comments-list">
            @foreach ($comment->allChildren as $children)
                @livewire('comment-item', ['comment' => $children])
            @endforeach
        </ul>
    @endif
    
</li>
