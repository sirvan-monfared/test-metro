<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 fill-gray-500">
        <path fill-rule="evenodd"
            d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 004.25 22.5h15.5a1.875 1.875 0 001.865-2.071l-1.263-12a1.875 1.875 0 00-1.865-1.679H16.5V6a4.5 4.5 0 10-9 0zM12 3a3 3 0 00-3 3v.75h6V6a3 3 0 00-3-3zm-3 8.25a3 3 0 106 0v-.75a.75.75 0 011.5 0v.75a4.5 4.5 0 11-9 0v-.75a.75.75 0 011.5 0v.75z"
            clip-rule="evenodd" />
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
