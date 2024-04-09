<template>
    <button @click="handleClick" class="bg-rose-600 text-white py-2 text-sm px-3 rounded-md flex items-center gap-1">
        {{ buttonLabel }}

        <loading-spinner v-show="isLoading"></loading-spinner>

        <svg v-show="!isLoading && isInCart" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
        </svg>
    </button>
</template>
<script>
import { route } from "../../routes.js";
import { computed, toRefs, ref } from 'vue';
import axios from 'axios';
import LoadingSpinner from "../UI/LoadingSpinner";
import useCart from "../../composables/useCart";
export default {
    props: {
        id: {
            required: true
        },
        alreadyInCart: {
            default: false
        },
        instantRedirect: {
            default: false
        }
    },
    components: {
        LoadingSpinner
    },
    setup(props) {
        const { id, alreadyInCart, instantRedirect } = toRefs(props);
        const isInCart = ref(alreadyInCart.value);
        const isLoading = ref(false);

        const { setCartCount } = useCart();

        const handleClick = () => {
            if (isInCart.value) {
                window.location.href = route('cart.show');
                return false;
            }

            addToCart();
        }

        const addToCart = async () => {
            isLoading.value = true;
            const { data: result } = await axios.post(route('cart.item.add', { course: id.value }))
                .catch(e => {
                    alert('امکان اضافه کردن آیتم به سبد خرید وجود ندارد');
                    isLoading.value = false;
                    return false;
                });
            if (!result) return;

            isInCart.value = true;
            isLoading.value = false;
            setCartCount(result.cart_count);
            console.log('added');
            if(instantRedirect.value) {
                document.location.href = route('cart.show');
            }
        }

        const buttonLabel = computed(() => {

            if (isInCart.value) {
                return 'ادامه سفارش';
            }

            if (instantRedirect.value) {
                return  'همین حالا ثبت نام کن';
            }

            return 'ثبت نام در دوره';
        })

        return {
            handleClick,
            buttonLabel,
            isLoading,
            isInCart
        }
    }
}
</script>
