<template>
    <div class="border-b border-neutral-200 flex items-center justify-between text-neutral-700 w-full">

        <form class="w-full p-4" @submit.prevent="submit" v-if="!state.applied_coupon.code">
            <label for="coupon_code">کد تخفیف</label>
            <div class="relative flex items-center">
                <input type="text" id="coupon_code"
                    class="bg-gray-100 border-gray-200 border-2 rounded-md text-xs h-12 w-full focus:bg-white focus:shadow-lg focus:ring-0 focus:border-gray-200 focus:border-2 focus:outline-0 transition-all duration-300"
                    placeholder="کد تخفیف را وارد کنید" v-model="state.coupon_code">
                <button type="submit" class="absolute left-3 bg-rose-500 py-1 px-2 text-xs text-white rounded-md">اعمال
                    کد
                </button>
            </div>
        </form>

        <div v-else class="relative bg-gray-100 border-2 border-dashed border-gray-300 px-3 py-4 rounded-sm text-sm">
            <span>کد تخفیف </span> <span>{{ state.applied_coupon.percent }}</span> <span> درصد </span>
            <span> {{ state.applied_coupon.code }} </span>
            <span> | {{ state.applied_coupon.description }} </span>

            <button type="button" @click="removeCoupon" class="absolute top-0 -translate-y-[50%] -left-2 bg-rose-500 text-white text-xs cursor-pointer py-1 px-2 rounded-full">
                <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>حذف کد تخفیف</span>
                </div>
            </button>
        </div>

        <input type="hidden" name="applied_coupon" v-model="state.applied_coupon.code">
    </div>
</template>

<script setup>
import { reactive } from 'vue';
import useCoupon from "../../composables/useCoupon";

const emit = defineEmits(['applied', 'removed'])

const state = reactive({
    coupon_code: null,
    applied_coupon: {
        code: null,
        percent: 0,
        description: null,
        discounted_price: null,
        final_price: null
    }
});

const { apply, showError } = useCoupon(state.coupon_code);


const submit = async () => {
    try {
        const result = await apply(state.coupon_code);

        state.applied_coupon.code = result.code;
        state.applied_coupon.percent = result.percent;
        state.applied_coupon.description = result.description;
        state.applied_coupon.discounted_price = result.discounted_price;
        state.applied_coupon.final_price = result.final_price;

        emit('applied', state.applied_coupon);
    } catch (error) {
        showError(error)
    }
}

const removeCoupon = () => {
    state.coupon_code = null;
    
    state.applied_coupon.code = null;
    state.applied_coupon.percent = 0;
    state.applied_coupon.description = null;
    state.applied_coupon.discounted_price = null;
    state.applied_coupon.final_price = null;
    emit('removed')
}
</script>
