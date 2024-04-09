<div class="w-100 mw-150px">
    <select name="status" class="form-select form-select-solid"  data-placeholder="وضعیت">
        @foreach(App\Enums\CommentStatus::cases() as $status)
            <option value="{{ $status->value }}" @selected($status->value == request()->status)>{{ $status->name() }}</option>
        @endforeach
    </select>
</div>