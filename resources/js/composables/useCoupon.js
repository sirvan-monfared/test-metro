import axios from "axios";
import {route} from "../routes";
import { createToaster } from "@meforma/vue-toaster";

export default function useCoupon() {
    const toaster = createToaster({
        position: 'top-right'
    });

    const apply = async (coupon_code) => {
        const {data: result} = await axios.post(route('cart.coupon.apply'), {
            coupon_code: coupon_code
        });

        if (! result) return false;

        return result;
    }


    const showError = (error) => {
        const message = error.response.data.error;

        if (message) {
            toaster.error(error.response.data.error);
            return false;
        }

        if (error.response.status === 422) {
            const validation_errors = error.response.data.errors;

            for (let error_item in validation_errors) {
                toaster.error(validation_errors[error_item][0]);
            }
            return false;
        }

        return toaster.error('مشکلی در اجرای عملیات به وجود آمده است');
    }

    return {
        apply,
        showError
    }

}
