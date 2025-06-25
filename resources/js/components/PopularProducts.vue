<template>
    <div class="main-container py-12 bg-[#f3f5f7]">

        <!-- Header -->
        <div class="flex justify-between items-center gap-4">
            <div class=" text-primary text-lg md:text-3xl font-bold leading-9">{{ $t('Popular Products') }}</div>

            <router-link to="/popular-products" class="flex items-center gap-1">
                <div class="text-[#343a40] text-base font-normal leading-normal">{{ $t('View All') }}</div>
                <ArrowRightIcon class="w-5 h-5 text-[#343a40]" />
            </router-link>
        </div>


        <div class="mt-8">
            <swiper
            :navigation="true"
            :modules="modules"
            :breakpoints="breakpoints"
            class="recentlyViewed"
            :loop="!loading"
            >
            <!-- Shimmer slides when loading -->
            <swiper-slide v-if="loading" v-for="i in 6" :key="`shimmer-${i}`">
                <div class="bg-white shadow-md rounded-lg p-4 animate-pulse">
                <div class="h-60 bg-gray-200 rounded"></div>
                <div class="mt-4 h-8 bg-gray-200 rounded"></div>
                <div class="mt-2 h-8 bg-gray-200 rounded"></div>
                <div class="mt-2 h-8 w-3/4 bg-gray-200 rounded"></div>
                </div>
            </swiper-slide>

            <!-- Real slides once data is loaded -->
            <swiper-slide v-else v-for="product in products" :key="product.id">
                <ProductCard2 :product="product" />
            </swiper-slide>
            </swiper>
        </div>
    </div>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, A11y } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import ProductCard2 from './ProductCard2.vue';

const props = defineProps({
    products: {
    type: Array,
        default: () => []
    },
    loading: {
        type: Boolean,
        default: false
  }
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
        slidesPerView: 3,
        spaceBetween: 20
    },

    1400: {
        slidesPerView: 4,
        spaceBetween: 20
    }
};
</script>
