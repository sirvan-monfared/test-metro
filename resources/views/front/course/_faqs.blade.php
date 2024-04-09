<section class="mt-8 lg:mt-12 " x-data="accordion({{ $course->faqs->pluck('id') }})">
    <h3 class="text-xl lg:text-2xl text-black font-bold">سوالات متداول</h3>

    <div class="mt-5 border border-gray-300">
        @foreach ($course->faqs as $faq)
            <div class="border-b border-gray-300" x-on:click="clicked({{ $faq->id }})">
                <div
                class="bg-gray-100 border-b border-gray-300 py-4 px-4 text-gray-700 flex items-center justify-between cursor-pointer">
                <div class="flex items-center gap-3 truncate">
                        <x-ui.icon icon="question"></x-ui.icon>
                        <p class="text-xs lg:text-lg font-semibold truncate">{{ $faq->title }}</p>
                    </div>
                    <x-ui.icon icon="caret-down" class="transition-all w-4 h-4 lg:w-6 lg:h-6 shrink-0" x-bind:class="items[{{ $faq->id }}] ? 'rotate-180' : ''"></x-ui.icon>
                </div>
                <div class="transition-all duration-500 overflow-hidden h-0" x-bind:class="items[{{ $faq->id }}] ? 'h-auto' : ''">
                    <div class="p-3 px-5 text-neutral-800">{!! $faq->body !!}</div>
                </div>
            </div>
        @endforeach
    </div>
</section>
