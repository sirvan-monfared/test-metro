<div class="mb-10">
    <span class="badge d-block badge-{{ $comment->status->color() }}">{{ $comment->status->name() }}</span>
    <div class="status-wrapper">
        <select class="form-select mt-4" wire:model="status">
            @foreach(App\Enums\CommentStatus::cases() as $status)
            <option value="{{ $status->value }}">{{ $status->name() }}</option>
            @endforeach
        </select>
    </div>
</div>