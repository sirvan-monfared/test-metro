@extends('admin.layouts.table', [
    'create_link' => route('admin.comment.create')
])


@section('filter')
    @include('admin.comment._filter')
@endsection

@section('table')
    <div class="card-body">
        <ul class="me-n5 pe-5 comments-list">
            @foreach($comments as $comment)
                @livewire('comment-item', [
                    'comment' => $comment,
                    'showChildren' => $showChildren,
                    'showReply' => $showReply
                ])
            @endforeach

        </ul>
    </div>
@endsection
