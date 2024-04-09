<article @class(['bg-white rounded-md shadow-lg p-8 flex flex-col justify-between border-3 text-2xl relative border-transparent transition-all duration-500 hover:-translate-y-2 hover:shadow-blogItem hover:border-lightBlue-600 hover:rounded-2xl', 'col-span-1 md:col-span-2 lg:col-span-3 lg:text-3xl' => isset($loop) && in_array($loop->index, [0,1]), 'col-span-1 md:col-span-2 ' => !isset($loop) || !in_array($loop->index, [0,1])])>
    <a href="{{ $podcast->viewLink()}}" class="absolute w-full h-full inset-0"><span class="hidden">Read more...</span></a>
    
    <h3><a href="{{ $podcast->viewLink() }}" class="font-medium leading-relaxed text-blueGray-600">{{ $podcast->title }}</a></h3>
    
    <div class="mt-4 text-lg text-gray-500 line-clamp-4">
        {!! $podcast->description !!}
    </div>

    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center gap-4">
            <img src="{{ asset('assets/img/bars.svg') }}" class="w-12 h-12" alt="podcast bars">

            <div class="name-date-box">
                <p class="text-base text-blueGray-600 font-medium">اپیزود {{ $podcast->episode }}</p>
                <p class="text-sm tracking-wide text-gray-500">{{ $podcast->duration }} دقیقه</p>
            </div>
        </div>
        <div class="p-[1px]">
            <a href="{{ $podcast->viewLink() }}" class="flex items-center justify-center rounded-full border-3 border-lightBlue-600 w-10 h-10">
                <x-ui.icon icon="video-play" class="stroke-lightBlue-600 fill-white rotate-180 -translate-x-0.5"></x-ui.icon>
            </a>
        </div>
    </div>
</article>