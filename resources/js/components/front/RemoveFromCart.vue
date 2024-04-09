<template>
    <button @click="removeFromCart" class="bg-none border-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
<!--        <i class='uil uil-times'></i>-->
    </button>
</template>
<script>
import useCart from "../../composables/useCart";
import {route} from "../../routes";
import {toRefs} from 'vue';
import axios from 'axios';

export default {
    emits: ['removed'],
    props: ['id'],
    setup(props, {emit}) {
        const {setCartCount} = useCart();
        const {id} = toRefs(props);

        const removeFromCart = async () => {
            const {data: result} = await axios.delete(route('cart.item.remove', {course: id.value}));

            if (! result) return false;

            setCartCount(result.cart_count);
            emit('removed', id.value);
        }

        return {
            removeFromCart
        }
    }
}
</script>
