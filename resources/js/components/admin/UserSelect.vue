<template>
    <v-select v-model="state.selected" :reduce="user => user.id" label="name" dir="rtl" :options="state.users" @search="fetchUsers"></v-select>
    <input type="hidden" name="user_id" v-model="state.selected">
</template>

<script>
import vSelect from 'vue-select';
import {reactive} from 'vue';
import axios from 'axios';
import {route} from "../../routes";

export default {
    components: {
        'v-select': vSelect
    },
    setup() {
        const state = reactive({
            loading: false,
            users: [],
            selected: null,
        });

        const fetchUsers = async (search, loading) => {

            if (! search) return false;

            loading(true);

            const {data: result} = await axios.get(route('admin.api.users'), {
                params: {
                    keyword: search
                }
            });

            loading(false);

            return state.users = result;
        }

        return {
            state,
            fetchUsers
        }
    }
}
</script>

<style scoped>
    @import '~vue-select/dist/vue-select.css';
</style>
