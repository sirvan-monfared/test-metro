<template>
    <div class="relative">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none ">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
        </svg>

      </div>
        <input type="text" name="birth_date" v-model="date" class="persian-date-picker bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        <DatePicker custom-input=".persian-date-picker" format="jYYYY/jMM/jDD" v-model="date"/>
    </div>
</template>

<script>
    import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
    import {toRefs, ref} from 'vue';
    export default {
        props: ['initial'],
        components: {
            DatePicker: Vue3PersianDatetimePicker
        },
        setup(props) {
            const date = ref(null)
            const {initial} = toRefs(props);

            if (initial.value) {
                date.value = initial.value;
            }

            console.log(date.value);

            return {
                date
            }
        }
    }
</script>
