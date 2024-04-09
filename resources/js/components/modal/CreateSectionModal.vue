<template>
    <form class="form" @submit.prevent="submit">
        <div class="d-flex flex-column mb-7 fv-row">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">عنوان</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="عنوان سرفصل را وارد کنید"></i>
            </label>
            <input type="text" class="form-control form-control-solid" name="title" v-model="section.title" />
        </div>

        <div class="d-flex flex-column mb-7 fv-row">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="">شماره فصل</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="شماره فصل را وارد کنید"></i>
            </label>
            <input type="text" class="form-control form-control-solid" v-model="section.order" />
        </div>

        <div class="d-flex flex-column mb-8">
            <label class="fs-6 fw-bold mb-2">توضیحات درس</label>
            <textarea class="form-control form-control-solid" rows="6" v-model="section.description"></textarea>
        </div>

        <div class="text-center pt-15">
            <button type="reset" @click="close" class="btn btn-light me-3">بی خیال</button>
            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                <span class="indicator-label">ثبت کن</span>
                <span class="indicator-progress">یه چندثانیه ...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</template>
<script>
import {reactive, onMounted } from "vue";

const initialValues = {
    title: null,
    description: null
}

export default {
    setup(_, {emit}) {
        const state = reactive({
            section: {}
        })

        onMounted(() => {
            Object.assign(state.section, initialValues);
        })

        const submit = () => {
            console.log('modal', state.section);
            emit('submitted', state.section);
            reset();
        }

        const close = () => {
            emit('close');
            reset();
        }

        const reset = () => {
            Object.assign(state.section, initialValues);
        }

        return {
            submit,
            close,
            section: state.section
        }
    }
}
</script>
