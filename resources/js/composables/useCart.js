import {reactive, computed} from 'vue';
import axios from 'axios';

const cartState = reactive({
    count: 0,
    stats: {
        subtotal: 0,
        discount: 0,
        final_price: 0,
    },
    coupon: {
        code: null,
        percent: 0,
        final_price: null
    },
    loading: false
})

export default function useCart() {
    const setCount = (count) => {
        cartState.count = count;
    }

    const count = computed(() => {
         return cartState.count;
    })

    const loadStats = async () => {
        cartState.loading = true;
        const {data: result} = await axios.get('/api/cart/stats');
        cartState.loading = false;

        if (! result) return;

        cartState.stats.subtotal = result.subtotal;
        cartState.stats.discount = result.discount;
        cartState.stats.final_price = result.final_price;
    }

    const applyCouponData = (coupon) => {
        cartState.stats.discount = coupon.discounted_price;
        cartState.coupon.code = coupon.code;
        cartState.coupon.percent = coupon.percent;
        cartState.coupon.final_price = coupon.final_price;
    }

    const removeCouponData = () => {
        cartState.stats.discount = 0;
        cartState.coupon.code = null;
        cartState.coupon.percent = 0;
        cartState.coupon.final_price = null;
    }

    const stats = computed(() => {
         return cartState.stats;
    })

    const isLoading = computed(() => {
         return cartState.loading;
    })


    return {
        applyCouponData,
        removeCouponData,
        setCartCount : setCount,
        loadCartStats: loadStats,
        cartStats: stats,
        cartCoupon: cartState.coupon,
        count,
        isLoading
    }
}
