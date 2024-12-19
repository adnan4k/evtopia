<template>
    <div class="main-container py-12 bg-slate-100">

        <!-- Header -->
        <div class="flex justify-between items-center gap-4">
            <div class="text-slate-800 text-lg md:text-3xl font-bold leading-9">{{ $t('Top Rated Shops') }}</div>

            <router-link to="/shops" class="flex items-center gap-1">
                <div class="text-slate-600 text-base font-normal leading-normal">{{ $t('View All') }}</div>
                <ArrowRightIcon class="w-5 h-5 text-slate-600" />
            </router-link>
        </div>


        <!-- Shops -->
        <div class="mt-8 ">
            <swiper :navigation="true" :modules="modules" :breakpoints="breakpoints" class="recentlyViewed" :loop="true">

            <swiper-slide v-for="shop in shops" :key="shop.id" class="w-full">
                <ShopCardTop :shop="shop"/>
            </swiper-slide>
        </swiper>

        </div>


    </div>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline';
import ShopCardTop from './ShopCardTop.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, A11y } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

const { shops } = defineProps(['shops']);

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
