<template>
    <div class="bg-white shadow-md p-5 mt-8">
        <form method="POST" @submit.prevent="submitComment">
            <div class="w-full text-white bg-red-600 py-3 text-lg text-center rounded-md" v-if="state.error">
                {{ state.error }}
            </div>
            <div class="w-full text-white bg-green-500 py-3 text-lg text-center rounded-md" v-if="state.success">
                {{ state.success }}
            </div>
            <div class="text-base font-bold" v-if="headingTitle && ! state.success">
                <h5>{{ headingTitle }}</h5>
            </div>
            <div v-if="replyToName" class="mt-8 mb-8 text-base font-bold text-right">
                <small>در حال پاسخ به {{ replyToName }} </small>
            </div>
        
            <div class="form-box" v-if="! state.success">
                <div class="my-5" v-if="isReview">
                    <star-rating 
                        v-model:rating="state.rating" 
                        :rounded-corners="true" 
                        :rtl="true" 
                        :show-rating="false" 
                        :star-size="35"
                        active-color="#F59E0B"
                        />
                </div>
                <div id="name-field" v-if="! username" class="mt-5 mb-8 text-base font-bold ">
                    <div class="text-base font-bold">
                        <h5>نام و نام خانوادگی</h5>
                    </div>
                    <div class="mt-3">
                        <div class="ui left icon input swdh11 swdh19">
                            <input type="text" v-model="state.name" placeholder="نام و نام خانوادگی" name="name" id="name" class="w-full border bg-white h-12 border-gray-300 focus:ring-1 focus:ring-blue-300 rounded-sm text-base">
                        </div>
                    </div>
                </div>
                <div class="text-base font-bold" :class="{ 'mt-3': username}">
                    <h5>{{ bodyTitle }}</h5>
                </div>
                <div class="mt-3">
                    <div class="ui left icon input swdh11 swdh19">
                        <textarea class="w-full border bg-white h-40 border-gray-300 focus:ring-1 focus:ring-blue-300 rounded-sm text-base" v-model="state.body" placeholder="نظرت ..." name="body" id="body"></textarea>
                    </div>
                </div>
                <div class="text-left mt-7 ">
                    <LoaderButton class="rounded-md text-white bg-rose-600 py-2 px-6 text-lg" :loading="state.isSending" title="ارسال"></LoaderButton>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import {reactive, inject, toRefs, computed} from 'vue';
import axios from 'axios';
import LoaderButton from "./LoaderButton";
import StarRating from 'vue-star-rating';

export default {
    props: ['replyToName', 'replyToId', 'type'],
    components: {
        LoaderButton,
        StarRating
    },
    setup(props) {
        const id = inject('id');
        const logged = inject('logged');
        const username = inject('username');
        const endpoint = inject('endpoint');

        const {replyToId, type} = toRefs(props);

        const state = reactive({
            isSending: false,
            name: null,
            body: null,
            rating: null,
            error: null,
            success: null
        })
        const submitComment = async () => {
            loading(true);
            const result = await axios.post(endpoint.value, {
                    name: state.name,
                    body: state.body,
                    parent_id: replyToId.value,
                    type: type.value,
                    rating: state.rating
                }).catch((error) => {
                    handleRequestError(error)
                }
            )

            if (result?.status === 200) {
                loading(false);
                state.error = null;
                state.success = result.data.message;
            }
        }
        const loading = (isLoading) => {
        	   state.isSending = isLoading
        }

        const handleRequestError = (error) => {
            loading(false);
            state.error = null;

            const status = error.response.status;

            if (status === 403) {
                state.error = 'برای ارسال دیدگاه، ابتدا وارد حساب  کاربری شوید';
            }else if (status === 422) {
                state.error = Object.values(error.response.data.errors)[0][0]
            } else if (status === 429) {
                state.error = error.response.data.message;
            }else {
                state.error = 'مشکل کوچکی پیش اومده. یه دوری بزن بعد بیا!';
            }
        }

        const isReview = computed(() => {
            return type.value === 'review';
        })

        const headingTitle = computed(() => {
            return isReview.value ? 'به کیفیت این دوره چند امتیاز میدی؟' : null;
        })

        const bodyTitle = computed(() => {
            return isReview.value ? 'چندکلمه در مورد تجربه ات از این دوره بگو...' : 'نظرت رو اینجا بگو';
        })

        return {
            state,
            logged,
            username,
            headingTitle,
            bodyTitle,
            isReview,
            submitComment
        }
    }
}
</script>
