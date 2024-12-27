

<template>

    <div class="md:gap-16 md:px-12">
        <h2 class=" text-center text-xl md:text-3xl font-bold text-primary uppercase py-5">Evtopia Knowledge Center </h2>
        <div class="flex md:flex-row  px-4 flex-col items-center justify-between gap-8 ">
        
        
            <div class="md:w-1/ w-full items-center">
                <h2 class="text-2xl font-bold ">
                    EV 
                    <span class="">Guides, Tips & Resource</span>

                </h2>
                <!-- <p class="mt-2 ">
                    <strong class="text-muted">
                        Empowering EV users with reliable products for a sustainable future.
                    </strong>
                </p> -->
                <p class="  pt-5">
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
                    
                <div class="w-full flex items-center justify-start mr-16 mt-3">
                    <router-link :to="`/knowledge-center`" 
                        class=" flex items-center justify-center py-3
                        transition duration-300 rounded-[10px] text-white px-3  
                        bg-primary-700 
                        hover:text-primary-200
                        hover:bg-primary-900
                        font-medium">
                        <div class="text-base font-normal leading-tight">{{ $t('Explore') }}</div>
                        <ArrowRightIcon class="w-5 h-5 ml-0.5" />
                    </router-link>
                </div>
            </div>
            <div class="md:w-1/2 w-full items-center">
                    <div v-if="props?.knowledge_hubs?.length > 0"  >
                        <div class="mt-4">
                            <swiper :navigation="true" :modules="modules" :breakpoints="breakpoints"  :loop="false">
                                <swiper-slide v-for="post in knowledge_hubs" :key="post.id">
                                    <div class="w-full  rounded-xl overflow-hidden  border border-slate-100 hover:border-primary transition-all duration-300">
                                        <div class="h-64 md:h-96 w-full relative">
                                            <!-- Title on top of the image -->
                                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center ">
                                                <router-link 
                                                    :to="`/knowledge-center/${post?.slug}`" 
                                                    class="text-primary-50 text-xl   md:text-3xl font-[roboto] font-bold leading-normal px-16"
                                                >
                                                    {{ post?.title.length > 140 ? post.title.slice(0, 140) + '...' : post.title }}
                                                </router-link>
                                                <!-- Read more button -->
                                                <router-link 
                                                    :to="`/knowledge-center/${post?.slug}`" 
                                                    class="absolute bottom-3 right-3 bg-primary-700 text-white text-sm font-medium py-2 px-3 rounded-md hover:bg-primary-900"
                                                >
                                                    {{ $t('Read More ...') }}
                                                </router-link>

                                                
                                            </div>
                                            
                                            <!-- Image with hover scale effect -->
                                            <img 
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300" 
                                                :src="post?.banner" 
                                                alt="banner" 
                                                loading="lazy" 
                                            />
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
    knowledge_hubs: Array
});
const modules = [Navigation, A11y];
const breakpoints = {
    320: {
        slidesPerView: 1,
        spaceBetween: 20
    }
};

</script>


