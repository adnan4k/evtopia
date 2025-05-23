<template>
    <div class="w-full group rounded-xl overflow-hidden px-1 border border-slate-100 hover:border-primary transition-all duration-300">
        <div class="h-72 w-full relative">
            <img class="w-full h-full object-cover group-hover:scale-105 transition duration-300" :src="props.post?.banner" alt="banner" loading="lazy" />

        </div>
        <div class="w-full px-1 pt-3 pb-1 relative transition duration-300">
            <div class="text-slate-950 text-lg font-[roboto] font-bold leading-normal">
                
                <router-link :to="`/knowledge-center/${props.post?.slug}`" >
                
                    {{ props.post?.title.length > 50 ? props.post.title.slice(0, 50) + '...' : props.post.title }}
                </router-link>
            </div>
            <div class="text-slate-500 mt-1 text-sm font-normal leading-normal ">
                {{ props.post?.short_description.length > 150 ? props.post.short_description.slice(0, 150) + '...' : props.post.short_description }}
            </div>
          
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    post: Object
});


</script>

