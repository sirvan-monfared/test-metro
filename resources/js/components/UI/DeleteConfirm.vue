<template>

    <div @click="show">
        <slot></slot>
    </div>

    <Modal v-model="open" modal-transition="slide-down" :no-spacing="true" :click-out="true">
        <div class="modal-dialog mw-650px">
            <div class="modal-content">

                <div class="modal-body scroll-y mx-5 mx-xl-15">
                    <h2 class="my-5">آیا مایل به حذف این آیتم هستید؟</h2>
                    <h5>هشدار! نتیجه این کار غیرقابل برگشت است</h5>
                </div>
                <div class="model-footer text-center my-7">
                    <button class="btn btn-default" @click="close">منصرف شدم</button>
                    <button class="btn btn-danger"  @click="confirm" :disabled="deleting">{{ confirmText }}</button>
                </div>
            </div>
        </div>
    </Modal>

</template>
<script>
    import {ref, toRefs, computed} from 'vue';
    import 'vue-neat-modal/dist/vue-neat-modal.css'
    import { Modal } from 'vue-neat-modal';
    import axios from 'axios';

    export default {
        name: 'DeleteConfirm',
        components: {
            Modal
        },
        props: ['action'],
        setup(props) {
            const {action} = toRefs(props);

            const open = ref(false);
            const deleting = ref(false);

            const show = () => {
                open.value = true;
            }
            const close = () => {
                open.value = false;
            }
            const confirm = async () => {
                loading(true);

                const result = await axios.delete(action.value)
                .catch((error) => {
                    console.log(error.response.data);
                    // loading(false);
                    alert(error.response.data);
                    location.reload();
                });

                // loading(false);
                if (result.status === 200) {
                    location.reload();
                }
            }

            const confirmText = computed(() => {
                return deleting.value ? 'در حال حذف ...' : 'بله حذف کن';
            })
            const loading = (value) => {
                deleting.value = value;
            }

            return {
                open,
                show,
                close,
                deleting,
                confirm,
                confirmText
            }
        }
    }
</script>
