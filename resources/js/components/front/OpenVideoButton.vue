<template>
    <div class="absolute w-full h-full flex items-center justify-center cursor-pointer" @click="toggle">
        <div class="bg-white flex items-center justify-center rounded-full w-16 h-16">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                stroke-width="1.5" class="w-10 h-10 stroke-black">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
            </svg>
        </div>
    </div>

    <Modal :show="show" :full-width="true" @close="toggle">
        <VideoModal :video="videoUrl"></VideoModal>
    </Modal>
</template>

<script setup>
import { ref, defineProps } from 'vue';
import Modal from '../front/modal/Modal.vue';
import VideoModal from '../modal/VideoModal.vue';

const props = defineProps({
    videoUrl: String
});

const show = ref(false);

const toggle = () => {
    show.value = !show.value;
}

</script>