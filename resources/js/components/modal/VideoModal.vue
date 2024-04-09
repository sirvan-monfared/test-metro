<template>
    <div class="h_iframe-aparat_embed_frame">
        <span style="display: block;padding-top: 57%"></span>
        <iframe :src="video + '?autoplay=true'" allow="autoplay" allowFullScreen="true" webkitallowfullscreen="true"
            mozallowfullscreen="true"></iframe>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    video: String
})



</script>

<style>
.h_iframe-aparat_embed_frame {
    position: relative;
}

.h_iframe-aparat_embed_frame .ratio {
    display: block;
    width: 100%;
    height: auto;
}

.h_iframe-aparat_embed_frame iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>