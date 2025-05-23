<template>
    <div class="w-full group rounded-xl overflow-hidden px-1 border border-slate-100 hover:border-primary transition-all duration-300">
        <div class="h-48 w-full relative">
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
            <div class="flex  gap-4 w-full mt-3">
                <!-- <span v-for="category in props.post?.categories" :key="category.id"
                    class="text-slate-900 text-sm font-medium leading-normal bg-primary rounded-lg px-2 py-1">
                    {{ category.name }}
                </span> -->
            </div>

            <div class="w-full flex items-center justify-between mt-3">
                <p class="text-slate-500 text-sm font-normal leading-normal"> {{props.post?.author?.name}} ({{props.post?.created_at}})</p>
                <router-link :to="`/knowledge-center/${props.post?.slug}`" 
                    class=" flex items-center justify-center px-3 py-2
                     transition duration-300 rounded-[10px] text-primary  
                     hover:text-black
                     font-medium">
                    <div class="text-base font-normal leading-tight">{{ $t('Read More') }}</div>
                    <ArrowRightIcon class="w-5 h-5 ml-0.5" />
                </router-link>
            </div>

        </div>
    </div>
</template>

<script setup>
import { StarIcon, ArrowRightIcon } from '@heroicons/vue/24/solid';

const props = defineProps({
    post: Object
});


</script>

