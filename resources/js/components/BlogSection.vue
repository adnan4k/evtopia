<template>
    <div v-if="props?.posts?.length > 0" class="main-container py-8 bg-slate-100 border-t border-slate-200">

        <div class="flex justify-between items-center gap-4">
            <div class=" text-2xl md:text-4xl mb-2 text-primary font-bold leading-9">{{ $t('News and Insights') }}</div>

            <router-link to="/blog" class="hidden md:flex items-center gap-1">
                <div class="text-slate-600 text-base font-normal leading-normal">{{ $t('View All') }}</div>
                <ArrowRightIcon class="w-5 h-5 text-slate-600" />
            </router-link>
        </div>
        <div class="mt-4">
            <swiper :navigation="true" :modules="modules" :breakpoints="breakpoints" class="recentlyViewed" :loop="false">
                <swiper-slide v-for="post in posts" :key="post.id">
                    <BlogCard :post="post" />
                </swiper-slide>
            </swiper>
        </div>

         <router-link to="/blog" class="flex md:hidden items-center justify-center mt-3 gap-1">
                <div class="text-slate-600 text-base font-normal leading-normal">{{ $t('View All') }}</div>
                <ArrowRightIcon class="w-5 h-5 text-slate-600" />
        </router-link>

    </div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, A11y } from 'swiper/modules';
import { ArrowRightIcon } from '@heroicons/vue/24/outline';

import BlogCard from './BlogCard.vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';

const props = defineProps({
    posts: Array
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
