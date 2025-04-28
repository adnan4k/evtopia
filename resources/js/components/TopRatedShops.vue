<template>
    <div class="main-container py-12 bg-slate-100">
  
      <!-- Header -->
      <div class="flex justify-between items-center gap-4">
        <div class="text-primary text-lg md:text-3xl font-bold leading-9">
          {{ $t('Top Rated Shops') }}
        </div>
        <router-link to="/shops" class="flex items-center gap-1">
          <div class="text-slate-600 text-base font-normal leading-normal">
            {{ $t('View All') }}
          </div>
          <ArrowRightIcon class="w-5 h-5 text-slate-600" />
        </router-link>
      </div>
  
      <!-- Shops Carousel -->
      <div class="mt-8">
        <swiper
          :navigation="true"
          :modules="modules"
          :breakpoints="breakpoints"
          class="recentlyViewed"
          :loop="!loading"
        >
          <!-- Shimmer Slides when loading -->
          <swiper-slide
            v-if="loading"
            v-for="i in skeletonCount"
            :key="`skeleton-${i}`"
            class="w-full"
          >
            <div class="bg-white shadow-md rounded-lg p-4 animate-pulse">
              <div class="h-32 bg-gray-200 rounded"></div>
              <div class="mt-4 h-4 bg-gray-200 rounded w-3/4"></div>
              <div class="mt-2 h-4 bg-gray-200 rounded w-1/2"></div>
            </div>
          </swiper-slide>
  
          <!-- Real Shop Slides when not loading -->
          <swiper-slide
            v-else
            v-for="shop in shops"
            :key="shop.id"
            class="w-full"
          >
            <ShopCardTop :shop="shop" />
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
  
  // Define props including loading state
  const props = defineProps({
    shops: {
      type: Array,
      default: () => []
    },
    loading: {
      type: Boolean,
      default: false
    }
  });
  
  // Local constants
  const skeletonCount = 5;
  const modules = [Navigation, A11y];
  const breakpoints = {
    320: { slidesPerView: 1, spaceBetween: 20 },
    768: { slidesPerView: 2, spaceBetween: 20 },
    1024: { slidesPerView: 4, spaceBetween: 20 },
    1280: { slidesPerView: 4, spaceBetween: 20 }
  };
  </script>
  
  <style scoped>
  /** Optional: tweak shimmer placeholder color **/
  .animate-pulse > div {
    @apply bg-gray-200;
  }
  </style>
  