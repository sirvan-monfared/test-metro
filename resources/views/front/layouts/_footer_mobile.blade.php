<footer class="md:hidden bg-white h-full sticky bottom-0 px-2 border-t border-t-gray-300 shadow-sm z-50">
    <div class="flex items-center justify-around gap-2">
        <a href="{{ route('course.list') }}" class="py-3 px-3 flex flex-col gap-1 items-center">
            <x-ui.icon icon="rocket" class="fill-gray-500"></x-ui.icon>
            <span class="text-xs">دوره ها</span>
        </a>
        <a href="{{ route('cart.show') }}" class="py-3 px-3 flex flex-col gap-1 items-center">
            <div class="relative">
                <shopping-cart-mobile :initial-count="{{ cart()->countItems() }}"></shopping-cart-mobile>
            </div>
            <span class="text-xs">سبد خرید</span>
        </a>

        @guest
            <a href="{{ route('login') }}" class="py-3 px-3 flex flex-col gap-1 items-center">
                <x-ui.icon icon="user-circle" class="fill-gray-500"></x-ui.icon>
                <span class="text-xs"> حساب کاربری </span>
            </a>
        @endguest


        @auth
            <a href="{{ route('dashboard') }}" class="py-3 px-3 flex flex-col gap-1 items-center">
                <x-ui.icon icon="user-circle" class="fill-gray-500"></x-ui.icon>
                <span class="text-xs"> حساب من</span>
            </a>
        @endauth
    </div>
</footer>
