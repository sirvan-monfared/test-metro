<template>
    <div class="relative">
<!--        <input type="hidden" name="birth_date" v-model="date">-->
        <date-picker popover :name="name" format="jYYYY/jMM/jDD" v-model="date"/>
    </div>
</template>

<script>
    import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
    import {toRefs, ref} from 'vue';
    export default {
        props: ['initial', 'name'],
        components: {
            DatePicker: Vue3PersianDatetimePicker
        },
        setup(props) {
            const date = ref(null)
            const {initial, name} = toRefs(props);

            if (initial.value) {
                date.value = initial.value;
            }

            return {
                date,
                name
            }
        }
    }
</script>
