<template>
    <div>
        <!-- Render components only if master data is available -->
        <FooterTop v-if="Object.keys(master).length > 0" :masterData="master" />
        <FooterBottom v-if="Object.keys(master).length > 0" :master="master" />
    </div>
</template>

<script setup>
import FooterTop from './FooterTop.vue';
import FooterBottom from './FooterBottom.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const master = ref({});
onMounted(() => {
    axios.get("/master").then((response) => {
        master.value = response.data.data;
    });
    window.scrollTo(0, 0);
});
</script>
