<template>
    <div class="main-container bg-primary-800">
        <!--==== Copyright ====-->
        <div class="py-5 w-full border-t border-primary-700">
            <div class="text-center text-white text-sm font-normal leading-tight">
                © {{ new Date().getFullYear() }} {{ master.web_footer_text || 'All rights reserved by Evtopia' }}
            </div>
        </div>
    </div>
</template>

<script setup>
const { master } = defineProps(['master']);
</script>
