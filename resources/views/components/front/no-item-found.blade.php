<div {{ $attributes->merge(['class' => 'w-full bg-white shadow-md rounded-md flex flex-col items-center justify-center p-8']) }} >

    <x-ui.icon icon="{{ $icon ?? 'info' }}" class="!h-28 !w-28 text-gray-600"></x-ui.icon>
    <p class="text-3xl text-gray-500 font-medium mt-3 text-center leading-relaxed">{{ $slot }}</p>
    <a href="{{ route('course.list') }}" class="mt-8 bg-rose-600 py-2 px-4 text-center text-white rounded-md font-medium hover:bg-rose-800">فعلا یه سر به دوره های سایت بزن</a>
</div>