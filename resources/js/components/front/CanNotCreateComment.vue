<template>
    <div>
        <div v-if="! logged || ! enrolled" class="bg-neutral-600 text-center w-full py-4 px-4 rounded-md mt-3 text-lg text-white">
            اگه میخوای نظرت رو در مورد دوره ارسال کنی باید دانشجوی این دوره باشی.
            <a href="#course-enrollment" class="text-blue-300 border-b border-dashed border-current hover:text-orange-500">ثبت نام در دوره</a>
        </div>
        <div v-else  class="mt-8 w-full text-center text-white bg-blue-600 py-3 text-lg rounded-md">
            شما قبلا نظرت رو در مورد این دوره فرستادی! ممنون که وقت گذاشتی           
        </div>
    </div>
</template>
<script>
    export default {
        props: ['logged', 'enrolled']
    }
</script>