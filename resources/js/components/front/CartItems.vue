<template>

    <div class="w-full bg-white shadow-md rounded-md flex flex-col items-center justify-center p-8" v-if="! state.items.length">
        <svg width="96" height="96" fill="none" class="mx-auto mb-6 text-gray-900"><path d="M36 28.024A18.05 18.05 0 0025.022 39M59.999 28.024A18.05 18.05 0 0170.975 39" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><ellipse cx="37.5" cy="43.5" rx="4.5" ry="7.5" fill="currentColor"></ellipse><ellipse cx="58.5" cy="43.5" rx="4.5" ry="7.5" fill="currentColor"></ellipse><path d="M24.673 75.42a9.003 9.003 0 008.879 5.563m-8.88-5.562A8.973 8.973 0 0124 72c0-7.97 9-18 9-18s9 10.03 9 18a9 9 0 01-8.448 8.983m-8.88-5.562C16.919 68.817 12 58.983 12 48c0-19.882 16.118-36 36-36s36 16.118 36 36-16.118 36-36 36a35.877 35.877 0 01-14.448-3.017" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M41.997 71.75A14.94 14.94 0 0148 70.5c2.399 0 4.658.56 6.661 1.556a3 3 0 003.999-4.066 12 12 0 00-10.662-6.49 11.955 11.955 0 00-7.974 3.032c1.11 2.37 1.917 4.876 1.972 7.217z" fill="currentColor"></path></svg>
        <p class="text-3xl text-gray-500 font-medium mt-3 text-center leading-relaxed">سبد خرید شما خالیه! </p>
        <a :href="route('course.list')" class="mt-8 bg-rose-600 py-2 px-4 text-center text-white rounded-md font-medium hover:bg-rose-800">یه سر به دوره های سایت بزن</a>
    </div>

    <div class="space-y-4">
        <div class="bg-white rounded-md shadow-md p-2.5 relative flex flex-col md:flex-row" v-for="item in state.items" :key="item.model.id">
            <a :href="item.model.get_view_link" class="block md:w-1/5">
                <img class="rounded-md w-full" :src="item.model.get_featured_image" :alt="item.model.title">
            </a>
            <div class="relative w-full mt-3 text-neutral-800 md:flex md:flex-col md:justify-between md:px-4 md:w-4/5 md:mt-0">
                <div class="pl-8">
                    <div class="absolute left-0">
                        <remove-from-cart :id="item.model.id" @removed="handleOnRemove"></remove-from-cart>
                    </div>
                    <a :href="item.model.get_view_link" class="block text-lg font-medium truncate">{{ item.model.title }}</a>
                </div>
        
                <div class="flex justify-between items-end mt-5 min-h-[2.5rem] md:mt-0 md:flex-1">
                    <p class="flex items-center gap-1 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm">مدت : {{ item.model.duration }} ساعت</span>
                    </p>
                    <div class="text-left" v-html="item.model.get_show_price"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import RemoveFromCart from "./RemoveFromCart";
import {toRefs, reactive} from 'vue';
import {route} from "../../routes";
export default {
    emits: ['cartUpdated'],
    components: {
        RemoveFromCart
    },
    props: ['items'],
    setup(props, {emit}) {
        const {items} = toRefs(props);
        const state = reactive({
            items: items.value
        })

        const handleOnRemove = (course_id) => {
            const index = state.items.findIndex((item) => item.id === course_id);
            state.items.splice(index, 1);

            emit('cartUpdated')
        }
        return {
            handleOnRemove,
            route,
            state
        }
    }
}
</script>
