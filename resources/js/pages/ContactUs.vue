<template>
    <div class="main-container">

        <div class="max-w-7xl mx-auto py-6 md:py-8 lg:py-12">
            <ContactUs />
        </div>

    </div>
</template>

<script setup>

import ContactUs from '../components/ContactUs.vue';



</script>

<style scoped>
.form-label {
    @apply text-slate-700 text-base font-normal leading-normal block;
}

.form-input {
    @apply p-3 rounded-lg border focus:border-primary w-full outline-none text-base font-normal leading-normal placeholder:text-slate-400;
}
</style>
