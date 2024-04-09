<div id="mobile-navigation" class="fixed top-0 right-0 bottom-0 left-0 backdrop-blur-sm z-10"
    x-bind:class="openMenu ? 'visible' : 'invisible'" x-cloak>

    <!-- UL Links -->
    <div class="absolute top-0 right-0 bottom-0 h-screen w-10/12 md:w-1/2 py-4 bg-white drop-shadow-2xl z-10 transition-all"
        x-bind:class="openMenu ? 'translate-x-0' : 'translate-x-full'">

        <div class="flex flex-col h-full justify-between px-5">

            <div class="">
                <div class="shadow-sm border-b border-gray-300 flex pb-3 justify-between items-center">
                    <a href="{{ route('front.home') }}">
                        <img src="{{ asset('assets/img/laraplus-with-text.svg') }}" class="h-12" alt="laraplus logo">
                    </a>
                    <button x-on:click="openMenu = ! openMenu" aria-expanded="openMenu"
                        aria-controls="mobile-navigation" aria-label="بستن منو">
                        <x-ui.icon icon="close"></x-ui.icon>
                    </button>
                </div>

                {{ $slot }}
            </div>

            @guest
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center gap-1 bg-rose-600 text-white px-5 py-2 text-2xl rounded-md shoadow-sm">

                    <x-ui.icon icon="sign-in"></x-ui.icon>

                    <span class="text-xl">ورود</span>
                </a>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST" class="-translate-y-[70px]">
                    @csrf

                    <button type="submit"
                        class="flex items-center w-full justify-center gap-1 bg-gray-600 text-white px-5 py-2 text-2xl rounded-md shoadow-sm">

                        <x-ui.icon icon="sign-out" ></x-ui.icon>

                        <span class="text-xl">خروج</span>
                    </button>
                </form>
            @endauth
        </div>
    </div>

    <button class="absolute inset-0" x-on:click="openMenu = ! openMenu" :aria-expanded="openMenu"
        aria-controls="mobile-navigation" aria-label="بستن منو">

    </button>
</div>
