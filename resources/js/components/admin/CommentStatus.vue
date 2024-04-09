<template>
    <span class="badge" :class="`badge-${color}`">{{ name }}</span>
    <div class="status-wrapper">
        <i class="fa fa-spinner fa-spin" v-show="sending"></i>

        <select class="mt-4" v-model="status">
            <option value="1">در انتظار تایید</option>
            <option value="2">فعال</option>
            <option value="3">هرزنامه</option>
        </select>
    </div>
</template>

<script>
import axios from 'axios';
import {ref, toRefs, watch, computed} from 'vue';
import { route } from '../../routes';

export default {
    name: 'CommentStatus',
    props: {
        id: {
            type: Number
        },
        currentStatus: {
            type: Number
        }
    },
    setup(props) {
        const {currentStatus, id} = toRefs(props)
        const status = ref(currentStatus.value);
        const sending = ref(false);

        watch(status, (newValue) => {
            changeStatus(newValue);
        })

        const changeStatus = async (value) => {
            loading(true);
            await axios.patch(route('admin.comment.update', {comment: id.value}), {
                status: status.value
            });
            loading(false);
        }

        const color = computed(() => {
            if (status.value == 1) {
                return 'warning';
            } else if (status.value == 2) {
                return 'success';
            } else if (status.value == 3) {
                return 'danger';
            } 
        });
        const name = computed(() => {
            if (status.value == 1) {
                return 'در انتظار تایید';
            } else if (status.value == 2) {
                return 'فعال';
            } else if (status.value == 3) {
                return 'هرزنامه';
            }
        });

        const loading = (value) => {
            sending.value = value
        }

        return {
            status,
            sending,
            color,
            name
        }
    }
}
</script>