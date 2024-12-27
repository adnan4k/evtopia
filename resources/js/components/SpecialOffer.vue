<template>
    <div class="main-container py-12 bg-[#f3f5f7]">
        <div class="flex justify-between items-center gap-4">
            <div class="  text-lg  text-primary md:text-3xl font-bold leading-9">{{ $t('Special Offers') }}</div>
            <router-link to="/most-popular" class="flex items-center gap-1">
                <div class="text-text-[#343a40] text-base font-normal leading-normal">{{ $t('View All') }}</div>
                <ArrowRightIcon class="w-5 h-5 text-[#343a40]" />
            </router-link>
        </div>
        <div class="mt-8 ">
            <swiper :navigation="true" :modules="modules" :breakpoints="breakpoints" class="recentlyViewed" :loop="true">
                <swiper-slide  v-for="product in products" :key="product.id">
                    <ProductCard :product="product"/>
                </swiper-slide>
            </swiper>
        </div>
    </div>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline';
import ProductCard from './ProductCard.vue';
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
