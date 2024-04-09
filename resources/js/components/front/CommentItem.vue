<template>
    <div class="h-full bg-white rounded-sm border border-gray-300 p-5" :id="`comment-${comment.id}`">
        <div :class="{ 'max-h-[250px] overflow-y-auto px-1' : scrollable }">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img :src="comment?.user?.image" alt="user avatar" class="rounded-full w-14 h-14" loading="lazy">
                    <div>
                        <p class="text-black">{{ comment.fname ? comment.fname : comment?.user?.name }}</p>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center text-amber-500" v-if="isReview && comment.rating">
                                <star-rating v-model:rating="comment.rating" :increment="0.01" :rating="comment.rating"
                                             :rounded-corners="true" :rtl="true" :read-only="true" :show-rating="false"
                                             :star-size="15" active-color="#F59E0B"/>
                            </div>
                            <div class="text-sm text-gray-500">{{ comment.created_at }}</div>
                        </div>
                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-6 h-6 hidden lg:block">
                    <path fill-rule="evenodd"
                          d="M10.5 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm0 6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <p class="mt-3 text-base text-gray-700 leading-relaxed">
                {{ comment.body }}
            </p>

            <template v-if="comment.children">
                <ul class="comments_list">
                    <CommentItem v-for="child  in comment.children" :key="child.id" :comment="child"></CommentItem>
                </ul>
            </template>
        </div>
    </div>
</template>
<script>
import { ref, computed, toRefs } from 'vue';
import CommentCreate from "./CommentCreate";
import StarRating from 'vue-star-rating';

export default {
    name: 'CommentItem',
    props: ['comment', 'type', 'scrollable'],
    components: {
        CommentCreate,
        StarRating
    },
    setup(props) {
        const replying = ref(false);
        const { type } = toRefs(props);

        const toggleReplying = () => {
            replying.value = !replying.value
        }

        const replyTriggerText = computed(() => {
            return replying.value ? 'بیخیال' : 'پاسخ به'
        })

        const isReview = computed(() => {
            return type.value === 'review';
        })

        return {
            toggleReplying,
            replyTriggerText,
            replying,
            isReview
        }
    }
}
</script>
<style scoped>
.reply-box {
    margin-top: 20px;
}

.review-info {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 5px;
}
</style>
