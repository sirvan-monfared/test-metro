<template>
    <file-pond
      name="file"
      ref="pond"
      label-idle="فایلت رو بکش و اینجا بنداز یا <span class='cursor-pointer text-blue-500'>روی این قسمت</span> کلیک کن"
      :allow-multiple="false"
      accepted-file-types="image/jpeg, image/png"
      :server="{
          url: url,
          process: {
            headers: {
              'X-CSRF-TOKEN': csrf
            },
            onload: handleSuccessUpload,
            onerror: handleFailedUpload
          }
        }"
      className="lara-file-uploader"
      :required="false"
      :allowPaste="false"
      :allowReplace="true"
      :allowRemove="true"
      :allowProcess="false"
      :storeAsFile="true"
      @removefile="handleRemoveFile"
    />
    <input type="hidden" name="filepond_file" v-model="uploaded_path">
    <input type="hidden" name="filepond_all_files" v-model="all_uploaded_files">
    
    <div class="fixed left-5 top-20" v-show="toast">
        <p class="w-full text-white bg-rose-600 py-3 px-6 text-lg text-center rounded-md">{{ toast }}</p>
    </div>
</template>
<script>
import {ref} from "vue";
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";

// Create component
const FilePond = vueFilePond();
export default {
    components: {
        FilePond
    },
    props: ['url', 'csrf'],
    setup() {
        const uploaded_path = ref(null);
        const all_uploaded_files = ref([]);
        const toast = ref(null);

        const handleFailedUpload = (data) => {
            const response = JSON.parse(data);
            const error = response.message;
            uploaded_path.value = null;

            toast.value = error;
            setTimeout(() => toast.value = null, 3000);
        }

        const handleSuccessUpload = (data) => {
            toast.value = null;
            
            const response = JSON.parse(data);
            uploaded_path.value = response.path;
            all_uploaded_files.value.push(response.path);
        }

        const handleRemoveFile = () => {
            // todo :: send request to server for removing uploaded file
        }

        return {
            handleFailedUpload,
            handleSuccessUpload,
            handleRemoveFile,
            uploaded_path,
            all_uploaded_files,
            toast
        }
    }
}
</script>
<style>
    .filepond--drop-label {
        font-family: IRANSans;
        background-color: white;
        color: black;
        direction: rtl;
        border: 2px dashed gray;
        min-height: 12rem !important;
    }
</style>
