<template>
    <div class="faq-draggables-wrapper">
        <draggable class="list-group" :list="state.items" group="group" itemKey="id">
            <template #item="{ element }" class="flex">
                <div class="faq-sortable-item__wrapper">
                    <div class="faq-sortable-item__remove flex-center" @click="remove(element)">
                        <i class="fa fa-minus"></i>
                    </div>

                    <div class="faq-sortable-item">

                        <div class="faq-sortable-item__title" @click="toggleCollapse(element)">
                            <i class="fa fa-bars drag-handler"></i>
                            <textarea name="faq__titles[]" placeholder="عنوان سوال ..." rows="1">{{ element.title }}</textarea>

                            <i class="fa fa-chevron-down"></i>
                        </div>
                        <div class="faq-sortable-item__body" v-show="element.open" contenteditable="">
                            <textarea name="faq__bodys[]" rows="3" placeholder="متن پاسخ ...">{{ element.body }}</textarea>
                        </div>
                    </div>
                </div>
            </template>
        </draggable>

        <div class="faq-add-item flex-center" @click="add">
            <i class="fa fa-plus"></i>
        </div>
    </div>
</template>
<script>
import draggable from "vuedraggable";
import { reactive, toRefs } from 'vue';

export default {
    components: {
        draggable
    },
    props: ['items'],
    setup(props) {
        const {items} = toRefs(props);

        const state = reactive({
            items: items.value
        })


        const toggleCollapse = (element) => {
            element.open = !element.open;
        }

        const remove = (element) => {
            const index = state.items.findIndex((item) => item.id === element.id);

            state.items.splice(index, 1);
        }

        const add = () => {
            state.items.push({
                id: Date.now(),
                title: null,
                body: null,
                open: true
            })
        }

        if (! state.items.length) {
            add();
        }

        return {
            toggleCollapse,
            remove,
            add,
            state
        }
    }

}
</script>