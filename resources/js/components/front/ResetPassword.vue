<template>
    <div class="flex flex-col gap-5">
        <div class="flex items-center justify-center relative">
            <a href="/">
                <img class="h-20" src="/assets/img/laraplus-logo.svg" alt="laraplus logo">
            </a>
        </div>
        <h2 class="text-2xl text-gray-800 font-medium">رمز عبور جدید خود را وارد کنید</h2>
        <p class="text-sm font-medium text-gray-500">رمزعبور شما باید حداقل شامل 8 کاراکتر باشد</p>

        <form method="POST" @submit.prevent="handleOnSubmit" class="flex flex-col gap-7">

            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="token" :value="resetToken">

            <div>
                <input v-model="formData.password" type="password" name="password" placeholder="رمزعبور" required=""
                    autofocus
                    class="ltr-input w-full bg-gray-100 outline-0 rounded-md border border-transparent focus:border focus:border-gray-300 focus:ring-0 focus:shadow-md hover:border hover:border-gray-300 hover:ring-0 hover:shadow-md">
            </div>

            <div>
                <input v-model="formData.password_confirm" type="password" name="password_confirmation"
                    placeholder="تکرار رمزعبور" required=""
                    class="ltr-input w-full bg-gray-100 outline-0 rounded-md border border-transparent focus:border focus:border-gray-300 focus:ring-0 focus:shadow-md hover:border hover:border-gray-300 hover:ring-0 hover:shadow-md">
            </div>

            <loader-button title="تغییر رمزعبور" :loading="isLoading" class="bg-rose-600 w-full !rounded-md py-2 px-3 text-white"></loader-button>
        </form>
    </div>
</template>
<script>
import { toRefs } from 'vue';
import useAuth from "../../composables/useAuth";
import { createToaster } from "@meforma/vue-toaster";
import OTPField from "../OTP/OTPField";
import ResendOTPField from "../OTP/ResendOTPField";
import LoaderButton from "./LoaderButton";

export default {
    props: {
        resetToken: {
            required: true,
        }
    },
    components: {
        OTPField,
        ResendOTPField,
        LoaderButton
    },
    setup(props) {
        const { resetToken } = toRefs(props);
        const { formData, resetPassword, showError, isLoading, reset: resetForm } = useAuth();
        const csrf = document.head.querySelector("meta[name='csrf-token']").content;

        const toaster = createToaster({
            position: 'top-right'
        });

        const handleOnSubmit = async () => {
            const result = await resetPassword(resetToken.value).catch((error) => {
                return showError(error);
            });

            if (!result.status) return false;

            toaster.success('رمزعبور با موفقیت تغییر یافت');

            if (result.data.redirect) {
                return redirectTo(result.data.redirect);
            }

            return false;
        };

        const redirectTo = (url) => {
            // resetForm();
            document.location.href = url;
        }

        return {
            handleOnSubmit,
            isLoading,
            resetToken,
            formData,
            csrf,
        }
    }
}
</script>

<style scoped>
input.prompt {
    direction: ltr !important;
    text-align: center !important;
    font-size: 18px;
    font-family: arial, sans-serif;
}
</style>
