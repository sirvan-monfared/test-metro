<template>
    <div class="discount-picker">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-10 fv-row">
                    <label class="required form-label">قیمت پایه</label>
                    <input type="text" name="price" v-model="state.price" class="form-control mb-2"
                           placeholder="قیمت پایه دوره"/>
                    <div class="text-muted fs-7">قیمت پایه دوره (بدون تخفیف و ...) را وارد کنید</div>
                </div>
                <div class="fv-row mb-10">
                    <label class="fs-6 fw-bold mb-2">
                        نوع تخفیف <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="یکی از انواع تخفیف های زیر برای اعمال روی دوره را انتخاب کنید"></i>
                    </label>
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true">
                        <div class="col">
                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" :class="{ 'active': state.discount_type == 1 }">
                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                    <input class="form-check-input" type="radio" name="discount_type" value="1" v-model="state.discount_type"/>
                                </span>
                                    <span class="ms-5">
                                    <span class="fs-4 fw-bolder text-gray-800 d-block">بدون تخفیف</span>
                                </span>
                            </label>
                        </div>
                        <div class="col">
                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" :class="{ 'active': state.discount_type == 2 }" data-kt-button="true">
                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                    <input class="form-check-input" type="radio" name="discount_type" value="2"  v-model="state.discount_type"/>
                                </span>
                                    <span class="ms-5">
                                    <span class="fs-4 fw-bolder text-gray-800 d-block">درصد تخفیف %</span>
                                </span>
                            </label>
                        </div>
                        <div class="col">
                            <label class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6" :class="{ 'active': state.discount_type == 3 }" data-kt-button="true">
                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                    <input class="form-check-input" type="radio" name="discount_type" value="3" v-model="state.discount_type"/>
                                </span>
                                    <span class="ms-5">
                                    <span class="fs-4 fw-bolder text-gray-800 d-block">تخفیف ثابت</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-10 fv-row" v-show="state.discount_type == 2">

                    <label class="form-label">درصد تخفیف را وارد کنید</label>

                    <div class="d-flex flex-column text-center mb-5">
                        <Slider v-model="state.discount_amount" v-if="state.discount_amount" :min="1" :max="100" />
                    </div>
                    <div class="text-muted fs-7">میزان درصد تخفیف برای اعمال روی این دوره را وارد کنید</div>
                </div>
                <div class="mb-10 fv-row" v-show="state.discount_type == 3">
                    <label class="form-label">قیمت نهایی پس از تخفیف</label>
                    <input type="text"  v-model="state.discount_amount" name="discount_amount" class="form-control mb-2" placeholder="قیمت نهایی پس از تخفیف"/>
                    <div class="text-muted fs-7">قیمت نهایی دوره پس از اعمال تخفیف را وارد کنید</div>
                </div>
            </div>

            <div class="col-md-4 final-price-wrapper">
                <div class="final-price">
                    <p class="final-price--title">قیمت نهایی دوره:</p>
                    <p class="final-price--amount" v-html="finalPrice"></p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {reactive, toRefs, onMounted, computed} from 'vue';
import Slider from '@vueform/slider';

export default {
    props: ['price', 'discountType', 'discountAmount'],
    components: {
        Slider
    },
    setup(props) {
        const {price, discountType, discountAmount} = toRefs(props);

        const state = reactive({
            price: 0,
            discount_type: 1,
            discount_amount: 1
        });

        onMounted(() => {
            if (price.value) {
                state.price = price.value;
            }
            if (discountType.value) {
                state.discount_type = discountType.value;
            }
            if (discountAmount.value) {
                state.discount_amount = discountAmount.value;
            }
            console.log({state});
        })

        const finalPrice = computed(() => {
            if (! state.price) return 0;

            if (state.discount_type == 1) {
                console.log(1111);
                return numberFormat(state.price);
            }

            if (state.discount_type == 2) {
                console.log(22222);
                const final_price = state.price - (state.discount_amount / 100) * state.price;
                console.log({final_price});
                return `<del>${numberFormat(state.price)}</del><ins>${numberFormat(final_price)}</ins>`;
            }

            if (state.discount_type == 3) {
                console.log(333);
                return `<del>${numberFormat(state.price)}</del><ins>${numberFormat(state.discount_amount)}</ins>`;
            }

            return numberFormat(state.price);
        })

        const numberFormat = (price) => {
            return new Intl.NumberFormat('en-US', {style : "decimal" }).format(price) + "<small class='currency'> تومان </small>";
        }

        const discountPercentageChanged = (e) => {
               state.discount_amount = e.target.value;
        }

        return {
            state,
            finalPrice,
            discountPercentageChanged
        }
    }
}
</script>

<style src="@vueform/slider/themes/default.css"></style>

<style>
    .discount-picker {
        display: flex;
        align-items: stretch;
    }
    .final-price-wrapper {
        border-right: 1px dashed silver;
        padding-right: 30px;
    }
    .final-price--title {
        font-size: 22px;
        font-weight: bold;
    }
    .final-price--amount {
        color: #49d8da;
        font-size: 40px;
    }
    .final-price--amount .currency {
        font-size: 50%;
    }
    .final-price--amount del, .final-price--amount ins {
        display: inline-block;
    }
    .final-price--amount del {
        color: darkred;
    }
    .final-price--amount ins{
        text-decoration: none;
    }
</style>
