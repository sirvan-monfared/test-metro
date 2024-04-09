<template>
    <form class="form" @submit.prevent="submit">
        <div class="d-flex flex-column mb-7 fv-row">
            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required">عنوان</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="عنوان درس را وارد کنید"></i>
            </label>
            <input type="text" class="form-control form-control-solid" v-model="lesson.title" />
        </div>
        <div class="d-flex flex-column mb-8">
            <label class="fs-6 fw-bold mb-2">توضیحات درس</label>
            <textarea class="form-control form-control-solid" rows="6" v-model="lesson.description"></textarea>
        </div>
        <div class="row fv-row">
            <div class="col-md-6">
                <div class="d-flex flex-column mb-7 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                        <span class="required">مدت زمان</span>
                    </label>
                    <input type="text" class="form-control form-control-solid" v-model="lesson.duration" />
                </div>
            </div>
            <div class="col-md-6">
                <label class="fs-6 fw-bold form-label">این درس را رایگان می کنید؟</label>
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" v-model="lesson.is_free" />
                    <span class="form-check-label fw-bold text-muted">رایگان کن!</span>
                </label>
            </div>
        </div>
        <div class="d-flex flex-column mb-8">
            <label class="fs-6 fw-bold mb-2">توضیحات کوتاه</label>
            <textarea class="form-control form-control-solid" rows="3" v-model="lesson.short_description"></textarea>
        </div>
        <div class="text-center pt-15">
            <button type="reset" @click="close" class="btn btn-light me-3">بی خیال</button>
            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                <span class="indicator-label">ذخیره </span>
                <span class="indicator-progress">یه چندثانیه ...<span
                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
</template>
<script>
import { reactive, onMounted } from "vue";
const initialValues = {
    title: null,
    description: null,
    duration: null,
    is_free: false,
    short_description: null
}
export default {
    setup(_, { emit }) {
        const state = reactive({
            lesson: {}
        })
        onMounted(() => {
            Object.assign(state.lesson, initialValues);
        })
        const submit = () => {
            console.log('modal', state.lesson);
            emit('submitted', state.lesson);
            reset();
        }
        const close = () => {
            emit('close');
            reset();
        }
        const reset = () => {
            Object.assign(state.lesson, initialValues);
        }
        return {
            submit,
            lesson: state.lesson,
        }
    }
}
</script>
