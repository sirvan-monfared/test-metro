<template>
    <div class="otp-separate-fields">
        <v-otp-input
            ref="otpInput"
            input-classes="otp-input"
            separator=""
            :num-inputs="6"
            :should-auto-focus="true"
            :is-input-num="true"
            :conditionalClass="['one', 'two', 'three', 'four', 'five', 'six']"
            :placeholder="[]"
            @on-change="handleOnChange"
            @on-complete="handleOnComplete"
            @paste="hello"
        />
    </div>
    <input type="hidden" name="otp" v-model="modelValue">
</template>
<script>
import VOtpInput from 'vue3-otp-input';
import {ref, watch, toRefs} from 'vue';
export default {
    emits: ['onCompleted', 'update:modelValue'],
    props: ['modelValue'],
    components: {
        VOtpInput,
    },
    setup(props, {emit}) {
        const otpInput = ref(null);
        const otpFinal = ref(null);
        const {modelValue} = toRefs(props);

        const handleOnComplete = (value) => {
            emit('onCompleted');
        };

        const handleOnChange = (value) => {
            emit('update:modelValue', value);
            otpFinal.value = value;
        };

        const clearInput = () => {
            otpInput.value.clearInput();
        }

        const hello = (event) => {
            const value = event.clipboardData.getData('text');
            emit('update:modelValue', value);
            otpFinal.value = value;
        }

        return { handleOnComplete, handleOnChange, clearInput, hello, otpInput, otpFinal, modelValue };
    }
}
</script>

<style>
.otp-separate-fields {
    direction: ltr;
    display: flex;
    justify-content: center;
}
.otp-input {
    width: 40px;
    height: 40px;
    padding: 5px;
    margin: 0 10px;
    font-size: 20px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.3);
    text-align: center;
}
/* Background colour of an input field with value */
.otp-input.is-complete {
    background-color: #e4e4e4;
}
.otp-input::-webkit-inner-spin-button,
.otp-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input::placeholder {
    font-size: 15px;
    text-align: center;
    font-weight: 600;
}
</style>
