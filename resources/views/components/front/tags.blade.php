@if($tags->count() > 0)
    <x-front.card>
        <ul class="flex flex-wrap gap-3">
            @foreach($tags as $tag)
                <li>
                    <a class="text-base bg-neutral-500 text-white font-medium flex items-center gap-1 py-1 px-2 rounded-md transition-all duration-200 hover:bg-amber-500 hover:text-neutral-900" href="{{ route('tag.show', $tag->tag_slug) }}">
                        <x-ui.icon icon="tag" class="svg-16"></x-ui.icon>
                        
                        <span>{{ $tag->tag_name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </x-front.card>
@endif