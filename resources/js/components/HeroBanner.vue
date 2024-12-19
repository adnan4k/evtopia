<template>
    <div class=" mt-3 grid grid-cols-4 gap-3 lg:gap-8">
        <!-- main-container -->
        <div class="col-span-4 lg:col-span-4">
            <!-- Main Banner Slider -->
            <swiper :navigation="false" :pagination="{ clickable: true }" :slides-per-view="1"
                    :space-between="1"
                    :modules="modules" class="mySwiper" :loop="true" :autoplay="{
                        delay: 3000,
                        disableOnInteraction: false
                    }">

                <swiper-slide v-for="banner in banners" :key="banner.id" class="relative">
                    <!-- Image -->
                    <img :src="banner.thumbnail" loading="lazy" class="w-full object-cover aspect-[9/4]" />

                    <!-- Dark Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

                    <!-- Text Overlay -->
                    <div class="absolute inset-0 flex items-center jp-4 md:p-8">
                        <div class="text-white p-4 customContainer md:p-6 rounded-lg flex flex-col  md:gap-5">
                            <h2 class="text-xl  md:text-[53px] lg:text-[50px] text-center md:text-start font-bold mb-2 Title">{{ banner.title }}</h2>
                            <!-- bannerTitle -->
                            <p class="text-xs hidden md:flex  md:text-[20px] lg:text-[20px] Description"


                                >{{ banner.description }}</p>
                            <!-- cta -->


                            <div class="flex gap-3 justify-center md:justify-start">

                                <!-- <div class="flex  justify-center md:justify-start">
                                    <a href="/about"
                                    class="text-white dynamicButton
                                            text-sm
                                            font-medium
                                            md:text-base
                                            md:font-bold mt-2  py-1 inline-flex items-center gap-2"
                                    >
                                        <span>
                                            {{$t('Read More') }}
                                        </span>

                                        <ArrowRightIcon class="w-5 h-5 arrow text-primary" />
                                    </a>
                                </div> -->

                                <div v-if="banner.cta_text != null " class="flex  justify-center md:justify-start">
                                    <a :href="banner.cta_url"
                                    class="text-white
                                            bg-[#28a745]
                                            rounded-md
                                            hover:bg-primary
                                            transition
                                            px-2
                                            dynamicButton
                                            py-1
                                            md:px-8
                                            md:py-3
                                            text-sm
                                            font-medium
                                            md:text-base
                                            md:font-bold mt-2   inline-flex items-center gap-2"
                                    >
                                        <span>
                                            {{ banner.cta_text }}
                                        </span>
                                        <ArrowRightIcon class="w-5 h-5 arrow text-white" />

                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </swiper-slide>

            </swiper>
        </div>


        <!-- Banner Thumbnails -->
        <!-- <div class="col-span-4 lg:col-span-1 flex flex-col sm:flex-row  lg:flex-col gap-4 lg:gap-8">
            <img v-for="ad in ads" :key="ad.id" :src="ad.thumbnail" loading="lazy" class="w-full h-[136px] sm:h-auto aspect-[9/6] object-cover rounded-lg" />
        </div> -->
    </div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, A11y,Autoplay } from 'swiper/modules';
import { ArrowRightIcon } from '@heroicons/vue/24/outline';

// Import Swiper styles
import 'swiper/css';

import 'swiper/css/navigation';
import 'swiper/css/pagination';

const modules = [
    Navigation, Pagination, A11y
    ,Autoplay
];

const props = defineProps({
    banners: Array,
    ads: Array
})

</script>

<style>
.mySwiper .swiper-button-prev,
.mySwiper .swiper-button-next {
    position: absolute;
    width: 28px;
    height: 28px;
    background-color: #fff;
    color: #475569 !important;
    border-radius: 8px !important;
    margin-top: auto;
}

.banner-title::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: 25%; /* Position the line at 25% of the text height */
    width: 50px;
    height: 25%; /* Set height relative to the text */
    background-color: currentColor; /* Matches the text color */
    z-index: -1; /* Ensures the line appears behind the text */
}
.mySwiper .swiper-button-next {
    left: auto;
    right: 20px;
    bottom: 20px;
}

.mySwiper .swiper-button-prev {
    left: auto;
    right: 58px;
    bottom: 20px;
}

.mySwiper .swiper-button-prev:after,
.mySwiper .swiper-button-next:after {
    font-size: 16px !important;
}

.mySwiper .swiper-pagination-bullet-active {
    @apply bg-primary w-6 h-2 rounded;
}


.bannerTitle {
    position: relative;
    display: inline-block; /* Ensure the pseudo-element aligns with the text */
    padding-left: 60px; /* Offset text to make room for the line on the left */
}

.bannerTitle::before {
    content: '' !important;
    position: absolute !important;
    top: 50%; /* Center the line vertically relative to the text */
    transform: translateY(-50%); /* Center-align */
    left: 0 !important;
    width: 50px !important;
    margin-top:2px;
    height: 50%; /* Set as a percentage of text height */
    background-color: white !important;
}


.dynamicButton {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem; /* Adjust gap as needed */
    position: relative;
    text-decoration: none;
    color: white;
}

.dynamicButton123::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 10%; 
    height: 0.5px; 
    background-color: #30602A;
    transition: width 0.5s ease; 
}

.dynamicButton:hover::after {
    width: 105%; /* Expand to full width on hover */
    height: 2px;
}



.dynamicButton .arrow {
    transition: transform 0.3s ease;
}

.dynamicButton:hover .arrow {
    transform: translateX(5px); /* Move text slightly */
}

.dynamicButton .arrow {
    transition: transform 0.3s ease;
}

.dynamicButton:hover .arrow {
    transform: translateX(10px); /* Push the icon forward on hover */
}

.Title{
    line-height: 50px;
}
.Description{
    line-height: 30px;
}
@media (max-width: 768px) {
    .bannerTitle {
        padding-left: 30px; /* Reduce space on smaller screens */
    }

    .bannerTitle::before {
        width: 20px !important; /* Adjust width */
        height: 25%; /* Adjust height for smaller screens */
    }

    .Title{
        line-height: 26px;
    }

}


/* Below 768px */
@media (max-width: 767px) {
    .customContainer {
        width: 100%;
    }
}

/* Between 768px and 1100px */
@media (min-width: 768px) and (max-width: 1100px) {
    .customContainer {
        width: 80%;
    }
}

/* Above 1100px */
@media (min-width: 1101px) {
    .customContainer {
        width: 60%;
    }
}

</style>
