

<template>
    <div class="flex md:flex-row  px-4 flex-col items-center justify-between gap-8 md:gap-16 md:px-12">
        <div class="md:w-1/2">
            <h2 class="text-2xl font-bold animate-border_about">
                EV 
                <span class="text-primary">Guides, Tips & Resource</span>

            </h2>
            <!-- <p class="mt-2 ">
                <strong class="text-muted">
                    Empowering EV users with reliable products for a sustainable future.
                </strong>
            </p> -->
            <p class=" text-justify pt-5">
                The EV Knowledge Center serves as a comprehensive resource for buyers, 
                sellers, and dealers in the electric vehicle industry,
                offering practical guides such as “How to Choose the Best Charger,”
                 selling tips for accessories, and strategies for expanding dealer networks.
                  It features technical how-tos, comparisons of EV models, and accessory compatibility charts,
                   ensuring users have access to valuable insights tailored to their needs.
                    Enhancing user experience, the platform can include downloadable PDFs 
                    and quick videos for easy reference, along with AI-driven recommendations based on user activity, 
                 making it an indispensable tool for navigating the evolving EV landscape.               
            </p>
                
            <div class="w-full flex items-center justify-end mr-16 mt-3">
                <router-link :to="`/knowledge-center`" 
                    class=" flex items-center justify-center py-3
                     transition duration-300 rounded-[10px] text-white px-3  
                     bg-primary-700 
                     hover:text-primary-200
                     hover:bg-primary-900
                     font-medium">
                    <div class="text-base font-normal leading-tight">{{ $t('Read More') }}</div>
                    <ArrowRightIcon class="w-5 h-5 ml-0.5" />
                </router-link>
            </div>
        </div>
        <div class="md:w-1/2 items-center">
                <div v-if="props?.knowledge_hubs?.length > 0"  >
                    <div class="mt-4">
                        <swiper :navigation="true" :modules="modules" :breakpoints="breakpoints"  :loop="false">
                            <swiper-slide v-for="post in knowledge_hubs" :key="post.id">
                                <div class="w-full group rounded-xl overflow-hidden px-1 border border-slate-100 hover:border-primary transition-all duration-300">
                                    <div class="h-72 w-full relative">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition duration-300" :src="post?.banner" alt="banner" loading="lazy" />
                            
                                    </div>
                                    <div class="w-full px-1 pt-3 pb-1 relative transition duration-300">
                                        <div class="text-slate-950 text-lg font-[roboto] font-bold leading-normal">
                                            
                                            <router-link :to="`/knowledge-center/${post?.slug}`" >
                                            
                                                {{ post?.title.length > 50 ? post.title.slice(0, 50) + '...' : post.title }}
                                            </router-link>
                                        </div>
                                        <div class="text-slate-500 mt-1 text-sm font-normal leading-normal ">
                                            {{ post?.short_description.length > 150 ? post.short_description.slice(0, 150) + '...' : post.short_description }}
                                        </div>
                                      
                                    </div>
                                </div>
                            </swiper-slide>
                        </swiper>
                    </div>
            
                </div>
            
        </div>
    </div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, A11y } from 'swiper/modules';
import { ArrowRightIcon } from '@heroicons/vue/24/outline';

import 'swiper/css';
import 'swiper/css/navigation';
import KnowledgeCenterCard from './KnowledgeCenterCard.vue';

const props = defineProps({
    knowledge_hubs: Array
});

const modules = [Navigation, A11y];
console.log("Knowledge Hubs : ",props.knowledge_hubs);
const breakpoints = {
    320: {
        slidesPerView: 1,
        spaceBetween: 20
    }
};

</script>

<style>
.recentlyViewed .swiper-button-prev,
.recentlyViewed .swiper-button-next {
    @apply bg-white w-8 h-8 rounded-full shadow border border-slate-200 text-slate-600;
}

.recentlyViewed .swiper-button-prev::after,
.recentlyViewed .swiper-button-next::after {
    @apply text-lg;
}

.recentlyViewed .swiper-button-next {
    right: 4px;
}

.recentlyViewed .swiper-button-prev {
    left: 4px;
}
</style>
