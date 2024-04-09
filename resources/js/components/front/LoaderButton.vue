<template>
    <button class="text-base font-medium rounded-sm text-center" :class="{'opacity-60 pointer-events-none': loading}" type="submit">{{ text }}</button>
</template>
<script>
import {toRefs, computed} from 'vue';
export default {
    props: {
        loading: {
            type: Boolean,
            required: true
        },
        title: {
            type: String
        },
        loadingText: {
            type: String,
            default: 'در حال ارسال ...'
        }
    },
    setup(props) {
        const {title, loading, loadingText} = toRefs(props)

        const text = computed(() => {
             if (loading.value) {
                 return loadingText.value;
             }

             return title.value;
        })

        return {
            text,
            loading
        }
    }
}
</script>
