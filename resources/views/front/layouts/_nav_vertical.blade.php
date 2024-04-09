<x-front.vertical-nav>
    <ul class="mt-14 flex flex-col gap-8 text-neutral-800 font-medium">
        <li @class(['text-rose-600' => request()->routeIs('front.home')])>
            <a class="flex items-center gap-2" href="{{ route('front.home') }}">
                <x-ui.icon icon="home"></x-ui.icon>
    
                <span>خانه </span>
            </a>
        </li>
    
        <li @class(['text-rose-600' => request()->routeIs('course.list')])>
            <a class="flex items-center gap-2 " href="{{ route('course.list') }}">
                <x-ui.icon icon="code"></x-ui.icon>
    
                <span>لیست دوره ها </span>
            </a>
        </li>
        <li @class(['text-rose-600' => request()->routeIs('front.blog')])>
            <a class="flex items-center gap-2 " href="{{ route('front.blog') }}" data-current="true">
                <x-ui.icon icon="edit"></x-ui.icon>
    
                <span> بلاگ </span>
            </a>
        </li>
        <li @class(['text-rose-600' => request()->routeIs('front.podcast')])>
            <a class="flex items-center gap-2 " href="{{ route('front.podcast') }}" data-current="true">
                <x-ui.icon icon="microphone"></x-ui.icon>
                <span> پادکست ها </span>
            </a>
        </li>
        <li @class(['text-rose-600' => request()->routeIs('front.about')])>
            <a class="flex items-center gap-2 " href="{{ route('front.about') }}" data-current="true">
                <x-ui.icon icon="about"></x-ui.icon>

                <span> درباره ما </span>
            </a>
        </li>
    </ul>
</x-front.vertical-nav>


