<template>
    <star-rating 
        :rounded-corners="false" 
        :rtl="true"
        :increment="options.increment"
        :show-rating="false" 
        :read-only="options.readOnly"
        :star-size="options.starSize"
        :rating="options.stars"
        active-color="#F59E0B"  />
</template>
<script>
import StarRating from 'vue-star-rating';
import { reactive, toRefs } from 'vue';

export default {
    name: 'rate-with-stars',
    props: ['show', 'size', 'stars'],
    components: {
        StarRating
    },
    setup(props) {
        const { show, size, stars } = toRefs(props);

        const options = reactive({
            readOnly: false,
            starSize: 35,
            increment: '1',
            stars: null
        });

        if (show.value) {
            options.readOnly = true;
            options.increment = '0.01';
        }

        options.starSize = +size.value;
        options.stars = stars.value;

        return {
            options
        }
    }
}
</script>

<style>
.sr-only {
    left: auto !important;
    right: auto !important;
}

</style>