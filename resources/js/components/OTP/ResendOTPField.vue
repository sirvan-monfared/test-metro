<template>
        <div class="countdown-container" v-if="counting">
            <vue-countdown :time="resend_timer" v-slot="{ minutes, seconds }" :transform="transformSlotProps" @end="handleOnCountdownEnd">
                <div class="countdown">
                    <span class="minutes">{{ minutes }}</span>
                    <span class="seperator"> : </span>
                    <span class="seconds">{{ seconds }}</span>
                </div>
            </vue-countdown>
            <div class="countdown-message">مانده تا دریافت کد مجدد</div>
        </div>
        <a class="resend-link" v-if="! counting" @click="handleOnResendClicked">
            دریافت مجدد کد تایید &#x000BB;
        </a>
</template>
<script>
import VueCountdown from '@chenfengyuan/vue-countdown';
import {ref, toRefs} from 'vue';
import useAuth from "../../composables/useAuth";
import { createToaster } from "@meforma/vue-toaster";

export default {
    components: {
        VueCountdown
    },
    props: ['initialTimer'],
    setup(props) {
        const {initialTimer} = toRefs(props);
        const resend_timer = ref(initialTimer.value);
        const counting = ref(true);
        const {resendOTP} = useAuth();

        const toaster = createToaster({
            position: 'top-right'
        });

        const handleOnCountdownEnd = () => {
            counting.value = false;
        }

        const handleOnResendClicked = async() => {
            const result = await resendOTP();

            if (! result.status) return false;

            resend_timer.value = result.timer;
            toaster.info('کد تایید ارسال شد');
            counting.value = true;
        }

        const transformSlotProps = (props) => {
            const formattedProps = {};
            Object.entries(props).forEach(([key, value]) => {
                formattedProps[key] = value < 10 ? `0${value}` : String(value);
            });
            return formattedProps;
        }

        return {
            transformSlotProps,
            handleOnResendClicked,
            handleOnCountdownEnd,
            counting,
            resend_timer
        }
    }
}
</script>
<style scoped>
.countdown-container, .resend-link {
    display: flex;
    gap: 5px;
    font-weight: 700;
    color: #838992;
    margin-top: 12px;
    justify-content: center;
    font-size: 12px;
}
.countdown {
    direction: ltr;
}
.resend-link{
    color: #15aabf;
    cursor: pointer;
}
.resend-link:hover{
    color: #66d9e8 !important;
}
</style>
