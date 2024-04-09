<template>
    <div class="recaptcha-wrapper">
        <vue-recaptcha sitekey="6LdpUp4gAAAAAG2IkC0F4zDqUON6oAVlRXDoaPTb"
                       size="normal"
                       theme="light"
                       hl="fa"
                       @verify="callbackVerify"
                       @expire="callbackExpired"
                       @fail="callbackFail"
                       ref="recaptchaRef">
        </vue-recaptcha>

        <input type="hidden" name="recaptcha_token" v-model="recaptcha_token">
    </div>
</template>
<script>
import { ref } from "vue";
import vueRecaptcha from 'vue3-recaptcha2';

export default {
    name: "recaptcha",
    components: {
        vueRecaptcha
    },
    setup(_, {expose}) {
        const recaptchaRef = ref(null);
        const recaptcha_token = ref(null);

        const callbackVerify = (response) => {
            recaptcha_token.value = response;
        };

        const callbackExpired = () => {
            actionReset()
        };

        const callbackFail = () => {
            actionReset();
        };

        const actionReset = () => {
            recaptchaRef.value.reset();
            recaptcha_token.value = null;
        };

        const response = () => {
        	return recaptcha_token.value
        }

        expose({
            actionReset,
            response
        })

        return {
            callbackVerify,
            callbackExpired,
            callbackFail,
            recaptcha_token,
            recaptchaRef
        };
    },
}
</script>

<style scoped>
    .recaptcha-wrapper {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
</style>
