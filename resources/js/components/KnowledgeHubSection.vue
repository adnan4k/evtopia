

<template>

    <div class="md:gap-16 md:px-8">
        <h2 class=" text-center text-2xl md:text-4xl font-bold text-primary  py-5"> {{ $t('evtopia_knowledge_center') }} </h2>
        <div class="flex md:flex-row  px-4 flex-col items-center justify-between gap-8 ">
        
        
            <div class=" w-full items-center">
                    <div v-if="props?.knowledge_hubs?.length > 0"  >
                       
                        <div class="mt-4">

                         <swiper :navigation="true" :modules="modules" :breakpoints="breakpoints" class="recentlyViewed" :loop="false">
                            <!-- Shimmer slides when loading -->
                            <swiper-slide v-if="loading" v-for="i in 6" :key="`shimmer-${i}`">
                                <div class="bg-white shadow-md rounded-lg p-4 animate-pulse">
                                    <div class="h-60 bg-gray-200 rounded"></div>
                                    <div class="mt-4 h-8 bg-gray-200 rounded"></div>
                                    <div class="mt-2 h-8 bg-gray-200 rounded"></div>
                                    <div class="mt-2 h-8 w-3/4 bg-gray-200 rounded"></div>
                                </div>
                            </swiper-slide>
                            <swiper-slide v-else v-for="hub in knowledge_hubs" :key="hub.id">
                                <!-- <BlogCard :post="hub" /> -->

                                 <div class="w-full group rounded-xl overflow-hidden px-1 border border-slate-100 hover:border-primary transition-all duration-300">
                                    <div class="h-48 w-full relative">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition duration-300" :src="hub?.banner" alt="banner" loading="lazy" />

                                    </div>
                                    <div class="w-full px-1 pt-3 pb-1 relative transition duration-300">
                                        <div class="text-slate-950 text-lg font-[roboto] font-bold leading-normal">
                                            
                                            <router-link :to="`/knowledge-center/${hub?.slug}`" >
                                            
                                                {{ hub?.title.length > 50 ? hub.title.slice(0, 50) + '...' : hub.title }}
                                            </router-link>
                                        </div>
                                        <div class="text-slate-500 mt-1 text-sm font-normal leading-normal ">
                                            {{ hub?.short_description.length > 150 ? hub.short_description.slice(0, 150) + '...' : hub.short_description }}
                                        </div>
                                        

                                        <div class="w-full flex items-center justify-between mt-3">
                                            <p class="text-slate-500 text-xs md:text-sm font-normal leading-normal"> {{hub?.author?.name}} ({{hub?.created_at}})</p>
                                            <router-link :to="`/knowledge-center/${hub?.slug}`" 
                                                class=" flex items-center justify-center px-3 py-2
                                                transition duration-300 rounded-[10px] text-primary  
                                                hover:text-black
                                                font-medium">
                                                <div class="text-xs  md:text-base font-normal leading-tight">{{ $t('Read More') }}</div>
                                                <ArrowRightIcon class="w-5 h-5 ml-0.5" />
                                            </router-link>
                                        </div>

                                    </div>
                                </div>
                            </swiper-slide>
                        </swiper>
                        </div>
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
const props = defineProps({
    knowledge_hubs: {
    type: Array,
    default: () => []
  },
  loading: {
    type: Boolean,
    default: false
  }
});

const modules = [Navigation, A11y];
const breakpoints = {
    320: {
        slidesPerView: 1,
        spaceBetween: 20
    },
    768: {
        slidesPerView: 2,
        spaceBetween: 20
    },
    1024: {
        slidesPerView: 3,
        spaceBetween: 20
    },

    1280: {
        slidesPerView: 3,
        spaceBetween: 20
    }
};

</script>


