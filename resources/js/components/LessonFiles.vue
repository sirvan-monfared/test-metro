<template>
    <div class="lesson-files mt-10">
        <div class="row" v-for="file in state.files" :key="file.id">
            <div class="col-md-4">
                <div class="mb-10 fv-row">
                    <label class="required form-label">نوع فایل</label>
                    <select v-model="file.type" name="file_type[]" class="form-select" data-control="select2" data-hide-search="true">
                        <option value="4">Link</option>
                        <option value="1">ویدئو</option>
                        <option value="2">Zip</option>
                        <option value="3">Pdf</option>
                    </select>
                </div>
            </div>
            <div class="col-md-7">
                <div class="mb-10 fv-row">
                    <label class="required form-label">آدرس فایل</label>
                    <input type="text" v-model="file.path" name="file_path[]" class="form-control mb-2" placeholder="آدرس فایل" />
                </div>
            </div>
            <div class="col-md-1">
                <a href="#" class="handle-button"  @click.prevent="removeFile(file.id)">
                    <i class="fa fa-minus text-danger handle-icon"></i>
                </a>
            </div>
        </div>

        <a href="#" class="handle-button"  @click.prevent="addFile">
            <i class="fa fa-plus text-danger handle-icon add-icon"></i>
        </a>
    </div>
</template>
<script>
import {reactive, onMounted, toRefs} from 'vue';
export default {
    props: ['currentFiles'],
    setup(props) {
        const {currentFiles} = toRefs(props);

        const state = reactive({
            files: []
        })

        onMounted(() => {
            if (currentFiles.value.length) {
                addCurrentFiles()
            } else {
                addFile()
            }
        })

        const addCurrentFiles = () => {
        	 for(let file of currentFiles.value) {
                 addFile(file.id, file.type, file.path);
             }
        }

        const addFile = (id, type, path) => {
        	   state.files.push({
                   id: id || new Date().getTime(),
                   type: type || 1,
                   path: path || null
               })
        }

        const removeFile = (file_id) => {
        	   const index = state.files.findIndex((item) => item.id === file_id);

               state.files.splice(index, 1);
               console.log(state.files);
        }


        return {
            state,
            addFile,
            removeFile
        }
    }
}
</script>
<style scoped>
.handle-button {
    display: flex;
    justify-content: center;
}
.handle-icon{
    text-align: center;
    font-size: 50px;
    margin-top: 20px;
    cursor: pointer;
}
.add-icon {
    color: #61b7e5 !important;
}
</style>
