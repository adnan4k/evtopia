<template>
    <div class="bg-white flex gap-4 w-full group">
        <!-- product image -->
        <div class="w-[72px] h-[95px] shrink-0">
            <img :src="props.product?.service.thumbnail" alt="product" class="w-full h-full object-cover" loading="lazy" />
        </div>

        <div class="grow flex flex-col gap-2 border-b border-slate-200 pb-3 relative overflow-hidden">
        
            <div class="text-slate-950 text-base font-normal leading-normal truncate">
                {{ props.product?.service.name }}
            </div>

            <!-- Price Discount -->
            <div class="flex items-center gap-2">
                <div class="text-primary text-base font-bold leading-normal">
                    {{ master.showCurrency(props.product?.service.discounted_price > 0 ? props.product?.service.discounted_price : props.product?.service.price) }}
                </div>
                <!-- <div v-if="props.product?.discount_price > 0" class="text-slate-400 text-sm font-normal line-through leading-tight">{{ master.showCurrency(props.product?.price ) }}</div>
                <div v-if="props.product?.discount_percentage > 0" class="px-1 py-0.5 bg-red-500 rounded-2xl text-white text-xs font-medium">
                    {{ props.product?.discount_percentage }}% {{ $t('OFF') }}
                </div> -->
            </div>

            <!-- Size -->
            <div class="flex justify-between gap-2 flex-wrap w-full items-center">
                <!-- <div class="flex gap-2">
                    <div v-if="props.product?.size" class="min-w-8 p-1 bg-slate-100 rounded text-center text-slate-800 text-xs font-normal">
                       {{ props.product?.size }}
                    </div>
                    <div v-if="props.product?.color" class="min-w-8 p-1 bg-slate-100 rounded text-center text-slate-800 text-xs font-normal">
                       {{ props.product?.color }}
                    </div>
                </div> -->
                <div>
                    Duration : {{ props.product?.service.duration }} Days
                </div>
                <!-- Quantity Increase Or Decrease -->
                <!-- <div class="p-1 rounded-lg border border-slate-200 flex gap-2">
                    <button class="bg-slate-200 w-6 h-6 rounded" @click="basketStore.decrementQuantity(props.product)">
                        <MinusIcon class="w-6 h-6 text-slate-800" />
                    </button>

                    <div class="w-6 text-center text-slate-950 text-base font-medium leading-normal">
                        {{ props.product?.quantity }}
                    </div>

                    <button class="bg-slate-200 w-6 h-6 rounded" @click="basketStore.incrementQuantity(props.product)">
                        <PlusIcon class="w-6 h-6 text-slate-800" />
                    </button>
                </div> -->
            </div>

            <!-- Delete button -->
            <button class="absolute top-0 right-0 hidden group-hover:block transition-all duration-300" @click="serviceStore.removeFromBasket(props.product.service)">
                <TrashIcon class="w-6 h-6 text-red-500"/>
            </button>

        </div>
    </div>
</template>

<script setup>
import { MinusIcon, PlusIcon, TrashIcon } from '@heroicons/vue/24/solid';

import { useMaster } from "../stores/MasterStore";
import { useBaskerStore } from "../stores/BasketStore";
import { useServiceStore } from "../stores/ServiceStore";

const basketStore = useBaskerStore();
const serviceStore = useServiceStore();
const master = useMaster();

const props = defineProps({
    product: Object
});

</script>
