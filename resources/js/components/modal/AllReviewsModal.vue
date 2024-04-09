<template>
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
        <div class="w-full h-full flex items-center justify-center" v-if="state.isLoading">
            <LoadingSpinner class="!w-12 !h-12"></LoadingSpinner>
        </div>

        <div class="hidden md:block md:col-span-3" v-if="! state.isLoading">
            <div class="flex flex-col gap-3">
                <div class="flex flex-col gap-3" v-if="state.info">
                    <div class="flex items-center gap-3">
                        <StarRate stars="5"></StarRate>
                        <span>({{ state.info.stars_5 }})</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <StarRate stars="4"></StarRate>
                        <span>({{ state.info.stars_4 }})</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <StarRate stars="3"></StarRate>
                        <span>({{ state.info.stars_3 }})</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <StarRate stars="2"></StarRate>
                        <span>({{ state.info.stars_2 }})</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <StarRate stars="1"></StarRate>
                        <span>({{ state.info.stars_1 }})</span>
                    </div>
                </div>

                <!-- <div class="relative flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        class="absolute right-2 w-5 h-5 stroke-gray-500 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>

                    <input class="h-12 w-full flex-auto border border-gray-500 px-8 rounded-md placeholder-gray-500"
                        type="text" placeholder="جستجو در دیگاه ها ...">
                </div> -->
            </div>
        </div>

        <div class="md:col-span-9" >
            <div v-if="state.comments.length" class="max-h-[calc(100vh-200px)] md:max-h-[500px] overflow-y-scroll" >
                <CommentItem type="review" v-for="comment in state.comments" :key="comment.id" :comment="comment" :scrollable="false" class="border-0 border-y">
                    </CommentItem>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from 'axios';
import { reactive, onMounted } from 'vue';
import { route } from '../../routes.js';
import LoadingSpinner from '../UI/LoadingSpinner';
import CommentItem from '../front/CommentItem';
import StarRate from '../UI/StarRate.vue';

const props = defineProps({
    'course': Number
})

const state = reactive({
    comments: [],
    info: [],
    isLoading: false
});

onMounted(() => {
    loadComments();
    loadMetaData();
})

const loadComments = async () => {
    state.isLoading = true;

    const { data: result } = await axios.get(route('api.course.comment.index', { course: props.course }));

    state.comments = result.data;
    state.isLoading = false;
}

const loadMetaData = async () => {
    const { data: result } = await axios.get(route('api.course.comment.info', { course: props.course }));
console.log({result});
    state.info = result;
}
</script>
