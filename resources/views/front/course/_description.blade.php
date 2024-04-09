<div class="flex flex-col gap-4">
    <h3 class="text-2xl font-semibold text-black">توضیحات</h1>
        <div x-data="{ openDescription: false }">
            <div class="mt-5 text-base leading-loose text-black h-80 overflow-y-hidden mask-text
        prose max-w-none prose-h3:text-lg prose-h3:font-semibold prose-strong:text-rose-500 prose-blockquote:text-rose-500 prose-blockquote:text-center prose-blockquote:mx-auto prose-blockquote:p-2  prose-blockquote:w-fit"
                x-bind:class="{ 'h-80 overflow-y-hidden mask-text': !openDescription }">
                {!! $course->description !!}

            </div>
            <a href="#" class="mt-3 font-bold text-base text-blue-500 flex items-center gap-3"
                x-on:click.prevent="openDescription = ! openDescription">
                <span>
                    ادامه توضیحات
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 transition-all duration-500"
                    x-bind:class="{ 'rotate-180': openDescription }">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>
</div>
