<template>
    <div v-if="open">
        
        <div role="button" class="fixed z-40 w-screen h-screen inset-0 bg-gray-900 bg-opacity-60 cursor-default" @click="close"></div>

        <div 
            class="fixed z-50 w-full h-full inset-0 lg:inset-auto lg:w-1/2 lg:h-auto lg:top-1/2 lg:left-1/2 lg:-translate-x-1/2 lg:-translate-y-1/2 bg-white rounded-md drop-shadow-lg"
            :class="{'inset-auto top-1/2 -translate-y-1/2 left-0 !h-auto': fullWidth}">
            <div class="bg-white shadow-sm border-b-2 lg:border-none flex items-center lg:justify-end gap-2 px-5 py-3" v-if="! fullWidth">

                <div class="lg:hidden flex items-center gap-2 cursor-pointer" @click="close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                    </svg>
                    <span class="text-base text-gray-700">بازگشت</span>
                </div>

                <div class="hidden lg:block cursor-pointer" @click="close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>

            </div>

            <div class="px-5 mt-5 lg:mt-0 space-y-5" v-if="! fullWidth">

                <h4 class="text-xl text-center" v-if="title">{{ title }}</h4>

                <slot name="header"></slot>
            </div>

            <div :class="{'px-5 my-12' : ! fullWidth}">
                <slot></slot>
            </div>
        </div>

    </div>
</template>

<script setup>

import { ref, toRefs, watch } from 'vue';

const props = defineProps({
    show: Boolean,
    title: String,
    fullWidth: Boolean
});

const emit = defineEmits(['close'])

const { show } = toRefs(props);

const open = ref(show.value);

watch(show, (old) => {
    open.value = show.value;
});

const close = () => {
    open.value = false;
    emit('close');
}

</script>