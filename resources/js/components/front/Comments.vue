<template>
    <div class="flex items-center justify-center" v-if="state.isLoading">
        <LoadingSpinner class="!w-12 !h-12"></LoadingSpinner>
    </div>

    <div v-if="!state.isLoading" class="mt-5">
        <div v-if="state.comments.length">
            <swiper-container slides-per-view="1.2" space-between="10" speed="500"  :loop="false" ref="sliderRef"
                :breakpoints="swiperBreakpoints" :grab-cursor="true" class="grid grid-cols-1 md:grid-cols-2 items-stretch"
                id="swiper-container">
                <swiper-slide v-for="comment in state.comments" :key="comment.id">
                    <CommentItem :type="type" :comment="comment" :scrollable="true"></CommentItem>
                </swiper-slide>
            </swiper-container>
        </div>

        <button class="mt-3 border border-neutral-500 rounded-sm w-full py-2 px-4" @click="state.showReviewsModal = true"
            v-if="state.comments.length >= 4">مشاهده
            همه دیدگاه ها
        </button>


        <div class="card-item">
            <CommentCreate :type="type" v-if="canComment"></CommentCreate>
            <CanNotCreateComment v-else :logged="logged" :enrolled="enrolled"></CanNotCreateComment>
        </div>

        <Modal :show="state.showReviewsModal" @close="state.showReviewsModal = false"
            class="w-full inset-0 md:inset-auto lg:w-[50%]">
            <template #header>
                <div class="text-xl text-black font-bold flex items-center gap-3">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-6 h-6 fill-yellow-500 stroke-yellow-500">
                        <path fill-rule="evenodd"
                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                            clip-rule="evenodd" />
                    </svg>

                    <span> {{ rating }} </span>
                    <span> | </span>
                    <span> {{ count }} دیدگاه</span>
                </div>
            </template>
            <AllReviewsModal :course="id"></AllReviewsModal>
        </Modal>
    </div>
</template>
<script>
import { reactive, ref, toRefs, onMounted, provide } from 'vue';
import axios from 'axios';
import CommentItem from "./CommentItem";
import LoadingSpinner from "../UI/LoadingSpinner";
import CommentCreate from "./CommentCreate";
import CanNotCreateComment from './CanNotCreateComment.vue';
import Modal from '../front/modal/Modal.vue';
import AllReviewsModal from "../modal/AllReviewsModal.vue";

import { register } from 'swiper/element/bundle';
register();

export default {
    props: {
        'id': { required: true },
        'logged': { required: true },
        'username': {},
        'endpoint': { required: true },
        'type': {
            type: String,
            default: 'comment'
        },
        'can-comment': {
            type: Boolean,
            default: true
        },
        'enrolled': {
            type: Boolean,
            default: false
        },
        'count': {
            type: String
        },
        'rating': {
            type: String
        }
    },
    components: {
        CommentItem,
        LoadingSpinner,
        CommentCreate,
        CanNotCreateComment,
        Modal,
        AllReviewsModal,
    },
    setup(props) {
        const { id, logged, username, endpoint, canComment, count, rating } = toRefs(props);
        const sliderRef = ref (null);

        const state = reactive({
            isLoading: false,
            comments: [],
            showReviewsModal: false
        });

        const swiperBreakpoints = {
            640: {
                slidesPerView: 1.2,
                spaceBetween: 10
            },
            768: {
                slidesPerView: 2.2,
                spaceBetween: 10
            },
            1024: {
                slidesPerView: 2.2,
                spaceBetween: 10
            }
        }

        onMounted(() => {
            loadComments();
        })

        const loadComments = async () => {
            state.isLoading = true;

            const { data: result } = await axios.get(`${endpoint.value}`);

            state.comments = result.data;
            state.isLoading = false;
        }


        // const swiperEl = document.querySelector('swiper-container');
        // const swiperPrevButtonEl = document.getElementById('swiper-slide-prev');
        // const swiperNextButtonEl = document.getElementById('swiper-slide-next');

        // swiperPrevButtonEl.addEventListener('click', () => {
        //     swiperEl.swiper.slidePrev();
        // });
        // swiperNextButtonEl.addEventListener('click', () => {
        //     swiperEl.swiper.slideNext();
        // });



        provide('logged', logged);
        provide('username', username);
        provide('id', id);
        provide('endpoint', endpoint);

        return {
            state,
            post_id: id.value,
            canComment,
            closed,
            count,
            rating,
            swiperBreakpoints,
            sliderRef
        }
    }
}
</script>

