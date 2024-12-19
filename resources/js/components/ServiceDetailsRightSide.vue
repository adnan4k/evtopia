<template>
    <div class="flex flex-col md:flex-row xl:flex-col items-center gap-6">

        <div
            class="w-full grow md:flex lg:gap-6 xl:block p-4 bg-slate-50 rounded-xl border border-slate-100 space-y-2 xl:space-y-4">

            <div class="flex grow flex-col items-start xl:flex-row xl:items-center gap-2 xl:gap-3">
                <div class="w-10 h-10 bg-slate-100 rounded-xl justify-center items-center flex">
                    <img :src="'/assets/icons/clock.svg'" alt="" class="w-6 h-6">
                </div>
                <div>
                    <div class="text-slate-500 text-base font-normal leading-normal">
                        {{ $t('Estimated Service time') }}
                    </div>
                    <div class="mt-1 text-slate-950 text-base font-bold leading-normal">
                        {{ product.duration }} Days
                    </div>
                </div>
            </div>
        </div>

        <!-- Shop info -->
        <div 
        class="h-[330px] hover:border-primary transition w-full grow rounded-xl border border-slate-100 xl:mt-6 relative overflow-hidden"
        :style="{ backgroundImage: `url(${banner})`, backgroundSize: 'cover', backgroundPosition: 'center' }">
        <div class="absolute bottom-4 left-0 w-full px-4">
            <a href="https://evtopia.birhanu.et/"
                target="_blank"
                         class="bg-primary-600 text-white py-2 w-full block rounded-md text-sm font-semibold shadow-md hover:bg-primary-700 transition text-center">
                {{ $t('Learn and Grow') }}
            </a>
        </div>
    </div>
   

    </div>

    <!-- Popular Products -->
    <!-- <div class="mt-8">
        <div class="text-slate-800 text-base font-medium leading-normal">
            {{ $t('Popular Services') }} 
        </div>

        <div class="flex gap-4 md:grid md:grid-cols-2 lg:grid-cols-3 xl:block xl:space-y-4 mt-4 overflow-x-auto">
            <div v-for="product in serviceProducts" :key="product.id" class="w-[320px]  md:w-full shrink-0">
                <ProductCardHorizontal :product="product" />
            </div>
        </div>

    </div> -->
</template>

<script setup>
import { StarIcon } from '@heroicons/vue/24/solid';
import ProductCardHorizontal from './ProductCardHorizontal.vue';
import banner from '../assets/banner.png'
import { useMaster } from "../stores/MasterStore";
const masterStore = useMaster();

const props = defineProps({
    product: Object,
    serviceProducts: Array
});

</script>

<style lang="scss" scoped></style>
