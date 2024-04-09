import {ref, computed} from 'vue';
import {route} from "../routes";
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";

const authFormData = ref({
    username: null,
    password: null,
    password_confirm: null,
    otp: null,
    type: null,
    recaptcha: null,
    step: 'start',
    loading: false
})
export default function useAuth() {

    const toaster = createToaster({
        position: 'top-right'
    });

    const checkForUsername = async () => {
        addLoading();
        const {data: result} = await axios.post(route('api.auth.check_username'), {
            username: authFormData.value.username,
            recaptcha: authFormData.value.recaptcha
        });
        removeLoading();

        if (! result) return false;

        setType(result.type);

        return result;
    }

    const login = async () => {
        addLoading();
       const {data: result} = await axios.post(route('api.auth.login'), {
           'email': formData.value.username,
           'password': formData.value.password
       });
        removeLoading();
        if (! result) return false;

       return result;
    }

    const verifyOTP = async (url) => {
        addLoading();
        url = url || route('api.otp.verify');

       const {data: result} = await axios.post(url, {
           'identifier': formData.value.username,
           'otp': formData.value.otp,
           'recaptcha': formData.value.recaptcha
       })

        removeLoading();

        if (! result) return false;

        return result;
    }

    const resendOTP = async() => {
        addLoading();
        const {data: result} = await axios.post(route('api.otp.resend'), {
            'identifier': formData.value.username,
        });
        removeLoading();

        if (! result) return false;

        return result;
    }

    const checkForgotParam = async () => {
        addLoading();
        const {data: result} = await axios.post(route('api.forgot.check'), {
            username: authFormData.value.username,
            recaptcha: authFormData.value.recaptcha
        });
        removeLoading();

        if (! result) return false;

        setType(result.type);

        return result;
    }


    const resetPassword = async(token) => {
        addLoading();
        const {data: result} = await axios.post(route('api.password.reset'), {
            token: token,
            password: formData.value.password,
            password_confirmation: formData.value.password_confirm
        });
        removeLoading();

        if (! result) return false;

        return result;
    }

    const reset = () => {
        setStep('start');
        setUsername(null);
        setType(null);
    }

    const setStep = (step) => {
        authFormData.value.step = step;
        authFormData.value.password = null;
        removeLoading();
    }

    const setType = (type) => {
        authFormData.value.type = type;
    }

    const setUsername = (username) => {
        authFormData.value.username = username;
    }

    const setRecaptcha = (value) => {
        authFormData.value.recaptcha = value;
    }

    const addLoading = () => {
        formData.value.loading = true;
    }

    const removeLoading = () => {
        formData.value.loading = false;
    }

    const showError = (error) => {
        removeLoading();

        if (error.response.status === 401) {
            return toaster.error(error.response.data.message);
        }

        if (error.response.status === 422) {
            const errors = error.response.data.errors;
            for (let error_item in errors) {
                toaster.error(errors[error_item][0]);
            }
            return false;
        }

        return toaster.error('مشکلی در اجرای عملیات به وجود آمده است');
    }

    const formData = computed(() => {
         return authFormData.value;
    });

    const step = computed(() => {
        return authFormData.value.step;
    });

    const typeName = computed(() => {
        if (formData.value.type === 'email') return 'آدرس ایمیل';
        if (formData.value.type === 'mobile') return 'شماره موبایل';

        return null;
    })

    const isLoading = computed(() => {
        console.log(formData.value.loading);
         return formData.value.loading;
    })

    return  {
        checkForUsername,
        checkForgotParam,
        setStep,
        setType,
        setUsername,
        login,
        resendOTP,
        verifyOTP,
        resetPassword,
        reset,
        showError,
        addLoading,
        removeLoading,
        setRecaptcha,
        formData,
        step,
        typeName,
        isLoading
    }
}
