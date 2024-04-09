<template>
    <div>
        <div class="w-full h-full absolute inset-0 flex items-center justify-center pointer-events-none bg-gray-300 bg-opacity-50" v-if="isLoading">
            <LoadingSpinner></LoadingSpinner>
        </div>

        <coupon @applied="couponApplied" @removed="couponRemoved"></coupon>

        <div class="p-4 border-b border-neutral-200 flex items-center justify-between text-neutral-700">
            <h4 class="font-medium w-3/4">مجموع سبد خرید</h4>
            <div class="w-1/4 flex items-center flex-wrap gap-1.5" v-html="cartStats.subtotal"></div>
        </div>
        <div class="p-4 border-b border-neutral-200 flex items-center justify-between text-neutral-700">
            <h6 class="font-medium w-3/4">تخفیف</h6>
            <div class="w-1/4 flex items-center flex-wrap gap-1.5" v-html="cartStats.discount"></div>
        </div>
        <div class="p-4 border-b border-neutral-200 flex items-center justify-between">
            <h2 class="text-xl font-medium w-3/4">هزینه نهایی</h2>
            <div class="text-xl font-medium w-1/4 flex items-center flex-wrap gap-1.5" v-if="cartCoupon.code" v-html="cartCoupon.final_price"></div>
            <div class="text-xl font-medium w-1/4 flex items-center flex-wrap gap-1.5" v-else v-html="cartStats.final_price"></div>
        </div>
    </div>
</template>
<script>
import {onMounted} from 'vue';
import useCart from "../../composables/useCart";
import Coupon from "./Coupon.vue";
import LoadingSpinner from "../UI/LoadingSpinner";

export default {
    emits: ['couponAdded', 'couponRemoved'],
    components: {
        LoadingSpinner,
        Coupon
    },
    setup(_, {emit}) {
        const {loadCartStats, cartStats, cartCoupon, isLoading, applyCouponData, removeCouponData} = useCart();
        onMounted(() => {
            loadCartStats();
        })

        const couponApplied = (result) => {
            applyCouponData(result);
            emit('couponAdded', result.code);
        }

        const couponRemoved = () => {
            removeCouponData();
            emit('couponRemoved');
        }

        return {
            cartStats,
            isLoading,
            cartCoupon,
            couponApplied,
            couponRemoved
        }
    }
}
</script>
