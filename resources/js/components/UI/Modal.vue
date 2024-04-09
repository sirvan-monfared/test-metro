<template>
    <Modal modal-transition="slide-down" :no-spacing="true" :click-out="true">
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>{{ title}}</h2>

                    <div class="btn btn-sm btn-icon btn-active-color-primary" @click="$emit('close')">
                        <span class="svg-icon svg-icon-1">X</span>
                    </div>
                </div>

                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <slot></slot>
                </div>
            </div>
        </div>
    </Modal>
</template>
<script>
    import 'vue-neat-modal/dist/vue-neat-modal.css'
    import { Modal } from 'vue-neat-modal';

    export default {
        components: {
            Modal
        },
        props: {
            title: {
                required: false
            }
        },
        setup() {

        }
    }
</script>
