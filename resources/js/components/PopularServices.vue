<template>
    <div class="main-container py-12">

        <!-- Header -->
        <div class="flex justify-between items-center gap-4">
            <div class=" text-slate-800 text-lg md:text-3xl font-bold leading-9">{{ $t('Latest Services') }}</div>

            <router-link to="/services" class="flex items-center gap-1">
                <div class="text-slate-600 text-base font-normal leading-normal">{{ $t('View All') }}</div>
                <ArrowRightIcon class="w-5 h-5 text-slate-600" />
            </router-link>
        </div>

        <!-- Products -->
        <div class="mt-8 ">
            <swiper :navigation="true" :modules="modules" :breakpoints="breakpoints" class="recentlyViewed" :loop="true">
            <swiper-slide v-for="product in products" :key="product.id" class="w-full">
                <ServiceCard :product="product"/>
            </swiper-slide>

        </swiper>


        </div>

    </div>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline';
import ProductCard from './ProductCard.vue';
import ServiceCard from './ServiceCard.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, A11y } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

const props = defineProps({
    products: Array
})




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
        slidesPerView: 4,
        spaceBetween: 20
    },

    1280: {
        slidesPerView: 4,
        spaceBetween: 20
    }
};

</script>
