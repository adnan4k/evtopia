<template>
    <div class="main-container mt-8 mb-12">
      <div class="mt-8 relative">
        <!-- Prev/Next Buttons -->
        <button
          @click="swiperPrevSlide"
          class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 p-2 bg-white rounded-full shadow"
        >
          <ChevronLeftIcon class="w-5 h-5 text-gray-600" />
        </button>
        <button
          @click="swiperNextSlide"
          class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 p-2 bg-white rounded-full shadow"
        >
          <ChevronRightIcon class="w-5 h-5 text-gray-600" />
        </button>
  
        <!-- Swiper Carousel -->
        <swiper
          ref="swiperRef"
          :breakpoints="breakpoints"
          :loop="!loading"
          @swiper="onSwiper"
          :modules="[Navigation]"
          class="categories-swiper"
        >
          <!-- Shimmer Slides -->
          <swiper-slide v-if="loading" v-for="i in skeletonCount" :key="`skeleton-${i}`">
            <div class="animate-pulse p-2">
              <div class="h-32 bg-gray-200 rounded-lg mb-2"></div>
              <div class="h-4 bg-gray-200 rounded w-3/4 mx-auto"></div>
            </div>
          </swiper-slide>
  
          <!-- Real Category Slides -->
          <swiper-slide v-else v-for="category in categories" :key="category.id">
            <CategoryCard :category="category" />
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, toRefs } from 'vue';
  import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid';
  import { Swiper, SwiperSlide } from 'swiper/vue';
  import { Navigation } from 'swiper/modules';
  import CategoryCard from './CategoryCard.vue';
  
  import 'swiper/css';
  import 'swiper/css/navigation';
  
  // Props including loading flag
  const props = defineProps({
    categories: {
      type: Array,
      default: () => []
    },
    loading: {
      type: Boolean,
      default: false
    }
  });
  
  const { loading } = toRefs(props);
  
  // Reference to swiper instance
  const swiperRef = ref(null);
  let swiperInstance = null;
  function onSwiper(swiper) {
    swiperInstance = swiper;
  }
  function swiperNextSlide() {
    if (swiperInstance) swiperInstance.slideNext();
  }
  function swiperPrevSlide() {
    if (swiperInstance) swiperInstance.slidePrev();
  }
  
  // Skeleton count matches max slides visible
  const skeletonCount = 8;
  
  // Responsive breakpoints
  const breakpoints = {
    320: { slidesPerView: 2, spaceBetween: 10 },
    768: { slidesPerView: 4, spaceBetween: 10 },
    1024: { slidesPerView: 6, spaceBetween: 30 },
    1280: { slidesPerView: 8, spaceBetween: 30 }
  };
  </script>
  
  <style scoped>
  .categories-swiper {
    position: relative;
  }
  </style>
  