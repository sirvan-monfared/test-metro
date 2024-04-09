<template>
    <div :class="{ 'col-span-12  lg:col-span-8' : cartItemsCount > 0, 'col-span-12' : cartItemsCount < 1 }">
        <cart-items :items="cartItems" @cartUpdated="handleOnCartUpdated"></cart-items>
    </div>

    <div class="col-span-12 lg:col-span-4 order-first lg:order-last relative" v-if="cartItemsCount > 0">
        <div class="bg-white rounded-md shadow-md border border-gray-100 p-7 h-full">
            <div>
                <h4 class="text-lg font-medium mb-2.5">صورتحساب</h4>
                <img src="/front/images/line.svg" alt="line" class="mb-2.5">
            </div>

            <div>

                <cart-receipt @couponAdded="couponAdded" @couponRemoved="couponRemoved"></cart-receipt>

<!--                @include('front.checkout._coupon_form')-->

                <form method="POST" class="mt-5" :action="route('cart.checkout')">
                    <input type="hidden" name="_token" :value="csrf">
                    <button type="submit" class="text-sm bg-rose-600 text-white py-2.5 px-5 w-full rounded-md">ثبت سفارش</button>
                    <input type="hidden" name="coupon" v-model="coupon_code">
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import {ref} from 'vue';
import CartItems from "./CartItems";
import CartReceipt from "./CartReceipt";
import {route} from "../../routes";
import useCart from "../../composables/useCart";

export default {
    components: {
      CartItems,
      CartReceipt
    },
    props: ['cartItems'],
    setup() {
        const csrf = document.head.querySelector('meta[name="csrf-token"]').content;
        const coupon_code = ref(null);

        const {loadCartStats, count: cartItemsCount} = useCart();

        const handleOnCartUpdated = () => {
            loadCartStats();
        }
        const couponAdded = (code) => {
            console.log(code);
            coupon_code.value = code;
        }
        const couponRemoved = () => {
            coupon_code.value = null;
        }

        return {
            handleOnCartUpdated,
            couponAdded,
            couponRemoved,
            route,
            coupon_code,
            csrf,
            cartItemsCount
        }
    }
}
</script>
