<template>
    <div class="sign_form">
        <div class="header">
            <a href="javascript:" class="go-back" @click="setStep('start')" v-if="['password', 'otp-register'].includes(step)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <a class="logo" href="/">
                <img src="/assets/img/laraplus-logo.svg" alt="laraplus-logo">
            </a>
        </div>
        <h2>{{ title }}</h2>
        <p>{{ subtitle  }}</p>

        <form method="POST" @submit.prevent="handleOnSubmit">

            <input type="hidden" name="_token" :value="csrf">

            <OTPField v-model="formData.otp" v-if="formData.step === 'otp-login'"></OTPField>

            <button class="login-btn" type="submit">تایید</button>

            <ResendOTPField v-if="formData.step === 'otp-login'" :initial-timer="resend_timer"></ResendOTPField>
        </form>
    </div>
</template>
<script>
import {computed, ref, toRefs} from 'vue';
import {route} from "../../routes";
import useAuth from "../../composables/useAuth";
import { createToaster } from "@meforma/vue-toaster";
import OTPField from "../OTP/OTPField";
import ResendOTPField from "../OTP/ResendOTPField";

export default {
    components: {
        OTPField,
        ResendOTPField
    },
    props: ['recipientType', 'recipient', 'timer'],
    setup(props) {
        const {timer, recipient, recipientType} = toRefs(props);
        const {formData, step, typeName, setStep, setType, setUsername, verifyOTP} = useAuth();
        const csrf = document.head.querySelector("meta[name='csrf-token']").content;
        const resend_timer = ref(timer.value);

        setUsername(recipient.value);
        setType(recipientType.value);

        setStep('otp-login');

        const toaster = createToaster({
            position: 'top-right'
        });

        const handleOnSubmit = async() => {
            const result = await verifyOTP().catch((error) => {
                if (error.response.status === 401) {
                    return toaster.error(error.response.data.message);
                }
                return false;
            });

            if (! result.status) return false;

            toaster.success('حساب کاربری با موفقیت ایجاد شد');
            redirectTo(result.redirect);
        };

        const title = computed(() => {
            return 'کد تایید را وارد کنید';
        })

        const subtitle = computed(() => {
            return `کد تایید برای ${typeName.value} ${formData.value.username} ارسال شده است`;
        })

        const redirectTo = (url) => {
            document.location.href = url;
        }

        return {
            handleOnSubmit,
            setStep,
            route,
            formData,
            csrf,
            step,
            title,
            subtitle,
            resend_timer
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
