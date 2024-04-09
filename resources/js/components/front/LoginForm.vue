<template>
    <div class="flex flex-col gap-5">
        <div class="flex items-center justify-center relative">
            <a href="javascript:" class="absolute right-0" @click="setStep('start')" v-if="['password', 'otp-register'].includes(step)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <a href="/" class="hidden md:block">
                <img class="h-20" src="/assets/img/laraplus-logo.svg" alt="laraplus logo">
            </a>
        </div>
        <h2 class="text-2xl text-gray-800 font-medium">{{ title }}</h2>
        <p class="text-sm font-medium text-gray-500">{{ subtitle  }}</p>

        <form method="POST" :action="route('login')" @submit.prevent="handleOnSubmit" class="flex flex-col gap-7">

            <input type="hidden" name="_token" :value="csrf">

            <div v-show="step === 'start'">
                <input type="text" name="username" v-model="formData.username" required=""
                class="w-full bg-gray-100 outline-0 rounded-md border border-transparent  focus:border focus:border-gray-300 focus:ring-0 focus:shadow-md hover:border hover:border-gray-300 hover:ring-0 hover:shadow-md">
            </div>

            <div class="ui search focus mt-15" v-show="step === 'password'">
                <input type="password" name="password" v-model="formData.password"
                class="w-full bg-gray-100 outline-0 rounded-md border border-transparent  focus:border focus:border-gray-300 focus:ring-0 focus:shadow-md hover:border hover:border-gray-300 hover:ring-0 hover:shadow-md">
            </div>

            <OTPField v-model="formData.otp" v-if="formData.step === 'otp-register'"></OTPField>

            <div v-if="step === 'password'">
                <a :href="route('password.request')" class="text-blue-500 text-sm border-current hover:border-b hover:border-dashed ">رمز عبورت رو فراموش کردی؟</a>
            </div>

            <Recaptcha ref="recaptchaRef" v-if="step === 'start' || step === 'otp-register'"></Recaptcha>

            <Loader-button title="ورود" :loading="isLoading" class="bg-rose-600 w-full !rounded-md py-2 px-3 text-white"></Loader-button>

            <ResendOTPField v-if="formData.step === 'otp-register'" :initial-timer="resend_timer"></ResendOTPField>
        </form>
    </div>
</template>
<script>
import {computed, ref} from 'vue';
import {route} from "../../routes";
import useAuth from "../../composables/useAuth";
import { createToaster } from "@meforma/vue-toaster";
import OTPField from "../OTP/OTPField";
import ResendOTPField from "../OTP/ResendOTPField";
import LoaderButton from "./LoaderButton";
import Recaptcha from "../Recaptcha";

export default {
    components: {
        OTPField,
        ResendOTPField,
        LoaderButton,
        Recaptcha
    },
    setup() {
        const {formData, step, typeName, isLoading, checkForUsername, setStep, login, verifyOTP, showError, setRecaptcha, reset: resetForm} = useAuth();
        const csrf = document.head.querySelector("meta[name='csrf-token']").content;
        const resend_timer = ref(30*1000);
        const recaptchaRef = ref(null);

        const toaster = createToaster({
            position: 'top-right'
        });

        const handleOnSubmit = async() => {
            if (formData.value.step === 'start') {
                return await submitStartStep();
            }

            if (formData.value.step === 'password') {
                return await submitPasswordStep();
            }

            if (formData.value.step === 'otp-register') {
                return await submitOtpRegisterStep();
            }
        };

        const submitStartStep = async () => {
            recaptchaSetValue();
            const result = await checkForUsername().catch((error) => {
                return showError(error)
            });
            recaptchaReset();

            if (! result) return false;

            if (result.username && ! result.otp_call) {
                setStep('password');
            }

            if (result.username && result.otp_call) {
                resend_timer.value = result.data.expires_at;
                setStep('otp-register');
            }
        }

        const submitPasswordStep = async () => {
            const result = await login().catch((error) => {
                return showError(error);
            });

            if (result.otp_call) {
                toaster.success('در حال انتقال ...');
                return redirectTo(route('otp.form'));
            }

            if (result.data?.redirect) {
                toaster.success('ورود با موفقیت انجام شد');
                return redirectTo(result.data.redirect);
            }

            return false;
        }

        const submitOtpRegisterStep = async () => {
            recaptchaSetValue();
            const result = await verifyOTP().catch((error) => {
                return showError(error);
            });
            recaptchaReset();

            if (! result.status) return false;

            toaster.success('حساب کاربری با موفقیت ایجاد شد');
            redirectTo(result.redirect);
        }

        const title = computed(() => {
            if (step.value === 'start') return 'ورود | ثبت نام'  ;
            if (step.value === 'password') return 'ورود'  ;
            if (step.value === 'otp-register') return 'کد تایید را وارد کنید';
        })

        const subtitle = computed(() => {
            if (step.value === 'start') return 'لطفا شماره موبایل یا ایمیل خود را وارد کنید'  ;
            if (step.value === 'password') return 'رمز عبور را وارد کنید'  ;
            if (step.value === 'otp-register') return `حساب کاربری با ${typeName.value} ${formData.value.username} وجود ندارد. برای ساخت حساب جدید،کد تایید برای این ${typeName.value} ارسال گردید.`;
        })

        const redirectTo = (url) => {
            // resetForm();
            document.location.href = url;
        }

        const recaptchaReset = () => {
            recaptchaRef.value.actionReset();
        }
        const recaptchaSetValue = () => {
            setRecaptcha(recaptchaRef.value.response())
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
            resend_timer,
            isLoading,
            recaptchaRef
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
