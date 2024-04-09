<article @class(['bg-white rounded-md shadow-lg p-8 flex flex-col justify-between border-3 text-2xl relative border-transparent transition-all duration-500 hover:-translate-y-2 hover:shadow-blogItem hover:border-emerald-600 hover:rounded-2xl', 'col-span-1 md:col-span-2 lg:col-span-3 lg:text-3xl' => isset($loop) && in_array($loop->index, [0,1]), 'col-span-1 md:col-span-2 ' => !isset($loop) || !in_array($loop->index, [0,1])])>
    <a href="{{ $post->viewLink()}}" class="absolute w-full h-full inset-0"><span class="hidden">Read more...</span></a>

    <h3><a href="{{ $post->viewLink() }}" class="font-medium leading-relaxed text-blueGray-600">{{ $post->title }}</a></h3>

    <div class="mt-4 text-lg text-gray-500">
        {!! $post->short !!}
    </div>

    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center gap-4">
            <img src="{{ asset('front/images/sirvan-monfared.jpg') }}" class="w-12 h-12 rounded-full border-3 border-blueGray-600" alt="sirvan-monfared">
            <div>
                <p class="text-base text-blueGray-600 font-medium">سیروان منفرد</p>
                <p class="text-sm tracking-wide text-gray-500">{{ $post->created_at->toJalali()->formatDifference() }}</p>
            </div>
        </div>
        <div class="p-[1px]">
            <a href="{{ $post->viewLink() }}" class="flex items-center justify-center rounded-full border-3 border-emerald-600 w-10 h-10">
                <x-ui.icon icon="arrow-left" class="stroke-emerald-600"></x-ui.icon>
            </a>
        </div>
    </div>
</article>