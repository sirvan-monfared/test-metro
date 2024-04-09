<template>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-gray-500" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
        </path>
    </svg>
    <div
        class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full text-xs h-4 w-4 flex items-center justify-center">
        <span>{{ count }}</span>
    </div>
</template>
<script>
import useCart from "../../composables/useCart";
export default {
    props: {
        initialCount: {
            default: 0
        }
    },
    setup(props) {
        const { count, setCartCount } = useCart();
        setCartCount(props.initialCount);

        return {
            count
        }
    }
}
</script>
