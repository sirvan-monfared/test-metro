@foreach($categories as $category)
    <a href="{{ route('category.show', $category) }}" class="crse-cate">
        {{ $category->title }}
        @if (! $loop->last) | @endif
    </a>
@endforeach
