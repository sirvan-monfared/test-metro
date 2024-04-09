<header class="bg-white shadow-sm border-b-2 sticky top-0 z-10">
    <x-top-message></x-top-message>
    <div class="container mx-auto lg:max-w-screen-xl p-3 px-4 flex items-center justify-between">
        <div class="flex items-center justify-start gap-3">
            <button class="md:hidden flex items-center justify-center" x-on:click="openMenu = ! openMenu"
                x-bind:aria-expanded="openMenu" aria-controls="mobile-navigation" aria-label="منوی اصلی">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                </svg>
            </button>
            <div class="w-32 flex items-center">
                <a href="/">
                    <img src="{{ asset('assets/img/laraplus-with-text.svg') }}" class="h-12" alt="laraplus logo">
                </a>
            </div>
            <div class="hidden md:block">
                <nav>
                    <ul class="flex items-center justify-start gap-4 text-sm font-medium">
                        <li>
                            <a class="p-2 hover:bg-rose-500 hover:text-white hover:rounded-md transition-all duration-200" href="{{ route('front.home') }}">خانه </a>
                        </li>
                        <li @class(['active' => request()->routeIs('course.list')])>
                            <a class="p-2 hover:bg-rose-500 hover:text-white hover:rounded-md transition-all duration-200" href="{{ route('course.list') }}">لیست دوره ها </a>
                        </li>
                        <li @class(['active' => request()->routeIs('front.blog')])>
                            <a class="p-2 hover:bg-rose-500 hover:text-white hover:rounded-md transition-all duration-200" href="{{ route('front.blog') }}">بلاگ</a>
                        </li>
                        <li @class(['active' => request()->routeIs('front.podcast')])>
                            <a class="p-2 hover:bg-rose-500 hover:text-white hover:rounded-md transition-all duration-200" href="{{ route('front.podcast') }}">پادکست ها</a>
                        </li>
                        <li @class(['active' => request()->routeIs('front.about')])>
                            <a class="p-2 hover:bg-rose-500 hover:text-white hover:rounded-md transition-all duration-200" href="{{ route('front.about') }}">درباره ما</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="hidden md:flex items-center gap-6">
            <div class="relative">
                <a href="{{ route('cart.show') }}">
                    <shopping-cart :initial-count="{{ cart()->countItems() }}"></shopping-cart>
                </a>
            </div>

            @auth
                <auth-menu :user="{{ auth()->user() }}"></auth-menu>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center gap-1 bg-rose-500 text-white py-1 px-3 rounded-full"
                    title="ورود">
                    <x-ui.icon icon="sign-in" class="stroke-white"></x-ui.icon>
                    <span class="text-xl">ورود</span>
                </a>
            @endguest
        </div>
    </div>
</header>
