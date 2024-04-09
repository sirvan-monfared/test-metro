<template>
    <input name="tags" class="form-control mb-2 tagify-input" :value="initialTags" ref="input"/>
</template>
<script>
    import {onMounted, ref, reactive, toRefs} from 'vue';
    import Tagify from '@yaireo/tagify'

    export default {
        name: 'TagsInput',
        props: ['tags'],
        setup(props) {
            const input = ref(null);
            const {tags: initialTags} = toRefs(props);
            const state = reactive({
                tags: ["new", "trending", "sale", "discounted", "selling fast", "last 10"]
            })
            
            onMounted(() => {
                state.tags = initialTags.value;
                
                new Tagify(input.value, {
                    whitelist: state.tags,
                    dropdown: {
                        classname: "tagify__inline__suggestions",
                        enabled: 0,
                        closeOnSelect: false 
                    }
                })
            }) 

            return {
                input,
                initialTags
            }
        }
    }
</script>