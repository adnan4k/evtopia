<template>
    <div class="rounded-lg border transition-all mx-1 duration-300 group bg-white overflow-hidden relative"
        :class="props.product?.quantity > 0 ? 'hover:border-primary' : ''">

        <div class="flex flex-col">
            <div class="bg-white">
                <div class="w-full h-36 sm:h-52 overflow-hidden relative"
                    :class="props.product?.quantity > 0 ? '' : 'opacity-30'">
                    <div class="cursor-pointer" @click="showProductDetails">
                        <!-- thumbnail -->
                        <img :src="props.product?.thumbnail" loading="lazy"
                            class="w-full h-full group-hover:scale-110 transition duration-500 object-cover" />
                    </div>



                    <!--discount--->
                    <div v-if="props.product?.discount_percentage > 0"
                        class="px-1 py-0.5 bg-red-500 rounded-2xl text-white text-xs font-medium absolute top-2 left-2">
                        {{ props.product?.discount_percentage }}% {{ $t('OFF') }}
                    </div>

                    <!--favorite-->
                    <button v-if="props.product?.is_favorite"
                        class="absolute top-2 right-2 w-9 h-9 rounded-[10px] justify-center items-center flex cursor-pointer bg-white"
                        @click="favoriteAddOrRemove">
                        <HeartIcon class="w-6 h-6 text-red-500" />
                    </button>

                    <!--unfavorite-->
                    <button v-else
                        class="absolute flex sm:hidden group-hover:flex top-2 right-2 w-9 h-9 rounded-[10px] justify-center items-center cursor-pointer bg-white transition-all duration-300"
                        @click="favoriteAddOrRemove">
                        <HeartIconOutline class="w-6 h-6 text-slate-600" />
                    </button>

                </div>
                <div class="cursor-pointer" @click="showProductDetails">
                    <div class="bg-white p-2 flex flex-col items-start gap-2 col-span-2">

                        <div class="flex justify-between items-center w-full">
                            <div class="text-slate-950 text-base font-normal leading-normal truncate w-full"
                                :class="props.product?.quantity > 0 ? '' : 'opacity-30'">
                                {{ props.product?.name }} - {{ props.product?.model }}
                            </div>

                            <div>
                                <span v-if="props.product?.pdf_file" class="text-primary cursor-pointer" @click.stop="openPdf">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>


                        </div>
                        <div class="flex justify-between gap-2"
                            :class="props.product?.quantity > 0 ? '' : 'opacity-30'">
                            <!-- price -->


                            <!--discount--->



                        </div>

                        <div class="flex justify-between items-center w-full">



                            <div class="flex items-center gap-2">
                                <div class="text-primary text-base font-bold leading-normal">
                                    {{ masterStore.showCurrency(props.product?.discount_price > 0 ?
                                        props.product?.discount_price : props.product?.price) }}
                                </div>
                                <!-- discount price -->
                                <div v-if="props.product?.discount_price > 0"
                                    class="text-slate-400 text-sm font-normal line-through leading-tight">
                                    {{ masterStore.showCurrency(props.product?.price) }}
                                </div>

                            </div>




                            <div v-if="props.product?.is_special">
                                🔥
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 space-y-2 w-full">

                            <div v-if="props.product?.driving_range" class="flex items-center gap-1 ml-0 md:ml-2">
                                <div class="text-slate-950   font-bold leading-tight flex items-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">

                                        <!-- pole: from y=4 down to y=16 -->
                                        <line x1="5" y1="4" x2="5" y2="16" />

                                        <!-- flag top edge: starts exactly at pole top (5,4) -->
                                        <line x1="5" y1="4" x2="14" y2="8" />

                                        <!-- flag bottom edge -->
                                        <line x1="5" y1="12" x2="14" y2="8" />

                                        <!-- oval base: center at (5,18), rx=3, ry=2 -->
                                        <ellipse cx="5" cy="18" rx="3" ry="2" fill="none" />
                                    </svg>

                                    {{ props.product?.driving_range }} Km



                                </div>

                            </div>

                            <div v-if="props.product?.battery_capacity" class="flex items-center gap-1">

                                <div class="flex items-center gap-1 text-slate-950 font-bold leading-tight">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        stroke="currentColor" stroke-width="0" version="1.2" baseProfile="tiny">
                                        <path d="
                                    M9 16
                                        c-.552 0-1-.447-1-1
                                        v-4
                                        c0-.553.448-1 1-1
                                        s1 .447 1 1
                                        v4
                                        c0 .553-.448 1-1 1
                                    z

                                    M6 16
                                        c-.552 0-1-.447-1-1
                                        v-4
                                        c0-.553.448-1 1-1
                                        s1 .447 1 1
                                        v4
                                        c0 .553-.448 1-1 1
                                    z

                                    M15 16
                                        c-.552 0-1-.447-1-1
                                        v-4
                                        c0-.553.448-1 1-1
                                        s1 .447 1 1
                                        v4
                                        c0 .553-.448 1-1 1
                                    z

                                    M12 16
                                        c-.552 0-1-.447-1-1
                                        v-4
                                        c0-.553.448-1 1-1
                                        s1 .447 1 1
                                        v4
                                        c0 .553-.448 1-1 1
                                    z

                                    M19 10
                                        c0-1.654-1.346-3-3-3
                                        h-11
                                        c-1.654 0-3 1.346-3 3
                                        v6
                                        c0 1.654 1.346 3 3 3
                                        h11
                                        c1.654 0 3-1.346 3-3
                                        1.104 0 2-.896 2-2
                                        v-2
                                        c0-1.104-.896-2-2-2
                                    z

                                    m-2 6
                                        c0 .552-.449 1-1 1
                                        h-11
                                        c-.551 0-1-.448-1-1
                                        v-6
                                        c0-.552.449-1 1-1
                                        h11
                                        c.551 0 1 .448 1 1
                                        v6
                                    z
                                    " />
                                    </svg>
                                    {{ props.product?.battery_capacity }}kWh
                                </div>

                            </div>


                            <div v-if="props.product?.year" class="flex items-center gap-1">

                                <div class="flex items-center text-slate-950 gap-2 font-bold leading-tight">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="1em"
                                        height="1em" fill="currentColor" stroke="currentColor" stroke-width="0">
                                        <path d="
                                        M0 464
                                            c0 26.5 21.5 48 48 48
                                            h352
                                            c26.5 0 48-21.5 48-48
                                            V192
                                            H0
                                            v272
                                            z

                                        M320 268
                                            c0-6.6 5.4-12 12-12
                                            h40
                                            c6.6 0 12 5.4 12 12
                                            v40
                                            c0 6.6-5.4 12-12 12
                                            h-40
                                            c-6.6 0-12-5.4-12-12
                                            v-40
                                            z

                                        m0 128
                                            c0-6.6 5.4-12 12-12
                                            h40
                                            c6.6 0 12 5.4 12 12
                                            v40
                                            c0 6.6-5.4 12-12 12
                                            h-40
                                            c-6.6 0-12-5.4-12-12
                                            v-40
                                            z

                                        M192 268
                                            c0-6.6 5.4-12 12-12
                                            h40
                                            c6.6 0 12 5.4 12 12
                                            v40
                                            c0 6.6-5.4 12-12 12
                                            h-40
                                            c-6.6 0-12-5.4-12-12
                                            v-40
                                            z

                                        m0 128
                                            c0-6.6 5.4-12 12-12
                                            h40
                                            c6.6 0 12 5.4 12 12
                                            v40
                                            c0 6.6-5.4 12-12 12
                                            h-40
                                            c-6.6 0-12-5.4-12-12
                                            v-40
                                            z

                                        M64 268
                                            c0-6.6 5.4-12 12-12
                                            h40
                                            c6.6 0 12 5.4 12 12
                                            v40
                                            c0 6.6-5.4 12-12 12
                                            H76
                                            c-6.6 0-12-5.4-12-12
                                            v-40
                                            z

                                        m0 128
                                            c0-6.6 5.4-12 12-12
                                            h40
                                            c6.6 0 12 5.4 12 12
                                            v40
                                            c0 6.6-5.4 12-12 12
                                            H76
                                            c-6.6 0-12-5.4-12-12
                                            v-40
                                            z

                                        M400 64
                                            h-48
                                            V16
                                            c0-8.8-7.2-16-16-16
                                            h-32
                                            c-8.8 0-16 7.2-16 16
                                            v48
                                            H160
                                            V16
                                            c0-8.8-7.2-16-16-16
                                            h-32
                                            c-8.8 0-16 7.2-16 16
                                            v48
                                            H48
                                            C21.5 64 0 85.5 0 112
                                            v48
                                            h448
                                            v-48
                                            c0-26.5-21.5-48-48-48
                                            z
                                        " />
                                    </svg>

                                    {{ props.product?.year }}
                                </div>

                            </div>

                            <div v-if="props.product?.peak_power" class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" stroke="currentColor" stroke-width="0">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path d="
                                    M11 21
                                        h-1
                                        l1-7
                                        H7.5
                                        c-.88 0-.33-.75-.31-.78
                                        C8.48 10.94 10.42 7.54 13.01 3
                                        h1
                                        l-1 7
                                        h3.51
                                        c.4 0 .62.19.4.66
                                        C12.97 17.55 11 21 11 21
                                    z
                                    " />
                                </svg>

                                <div class="text-slate-950  font-bold leading-tight">
                                    {{ props.product?.peak_power }} kW
                                </div>

                            </div>
                            <!-- <div v-if="props.product?.mileage" class="h-3 w-[0px] border border-slate-300"></div> -->



                            <div class="flex items-center gap-2" v-if="props.product?.acceleration_time">
                                <!-- <StarIcon class="w-4 h-4 text-yellow-400" /> -->

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="20" height="20"
                                    fill="currentColor" stroke="currentColor" stroke-width="0">
                                    <path d="
                                        M8 2
                                        a.5.5 0 0 1 .5.5
                                        V4
                                        a.5.5 0 0 1-1 0
                                        V2.5
                                        A.5.5 0 0 1 8 2

                                        M3.732 3.732
                                        a.5.5 0 0 1 .707 0
                                        l.915.914
                                        a.5.5 0 1 1-.708.708
                                        l-.914-.915
                                        a.5.5 0 0 1 0-.707

                                        M2 8
                                        a.5.5 0 0 1 .5-.5
                                        h1.586
                                        a.5.5 0 0 1 0 1
                                        H2.5
                                        A.5.5 0 0 1 2 8

                                        m9.5 0
                                        a.5.5 0 0 1 .5-.5
                                        h1.5
                                        a.5.5 0 0 1 0 1
                                        H12
                                        a.5.5 0 0 1-.5-.5

                                        m.754-4.246
                                        a.39.39 0 0 0-.527-.02
                                        L7.547 7.31
                                        A.91.91 0 1 0 8.85 8.569
                                        l3.434-4.297
                                        a.39.39 0 0 0-.029-.518
                                        z
                                        " />

                                    <!-- silhouette / outline -->
                                    <path fill-rule="evenodd" d="
                                        M6.664 15.889
                                        A8 8 0 1 1 9.336.11
                                        a8 8 0 0 1-2.672 15.78
                                        z

                                        m-4.665-4.283
                                        A11.95 11.95 0 0 1 8 10
                                        c2.186 0 4.236.585 6.001 1.606
                                        a7 7 0 1 0-12.002 0
                                        " />
                                </svg>

                                <!-- rating -->
                                <div class="text-slate-950 font-bold leading-tight">
                                    {{ props.product?.acceleration_time }} s
                                </div>

                                <!-- total sold -->

                                <!-- Stock Out -->
                                <!-- <div v-else class="text-right text-red-500 text-xs font-normal leading-tight">
                                    {{ $t('Stock Out') }}
                                </div> -->
                            </div>


                            <div class="flex  font-bold leading-tight flex items-center  gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="20" height="20"
                                    fill="currentColor" stroke="currentColor" stroke-width="0">
                                    <path d="
                                    M288 32
                                        c-80.8 0-145.5 36.8-192.6 80.6
                                        C48.6 156 17.3 208 2.5 243.7
                                        c-3.3 7.9-3.3 16.7 0 24.6
                                        C17.3 304 48.6 356 95.4 399.4
                                        C142.5 443.2 207.2 480 288 480
                                        s145.5-36.8 192.6-80.6
                                        c46.8-43.5 78.1-95.4 93-131.1
                                        c3.3-7.9 3.3-16.7 0-24.6
                                        c-14.9-35.7-46.2-87.7-93-131.1
                                        C433.5 68.8 368.8 32 288 32
                                    z

                                    M144 256
                                        a144 144 0 1 1 288 0
                                        a144 144 0 1 1 -288 0
                                    z

                                    m144-64
                                        c0 35.3-28.7 64-64 64
                                        c-7.1 0-13.9-1.2-20.3-3.3
                                        c-5.5-1.8-11.9 1.6-11.7 7.4
                                        c.3 6.9 1.3 13.8 3.2 20.7
                                        c13.7 51.2 66.4 81.6 117.6 67.9
                                        s81.6-66.4 67.9-117.6
                                        c-11.1-41.5-47.8-69.4-88.6-71.1
                                        c-5.8-.2-9.2 6.1-7.4 11.7
                                        c2.1 6.4 3.3 13.2 3.3 20.3
                                    z
                                    " />
                                </svg>

                                {{ props.product?.visit_count }}
                            </div>
                        </div>




                    </div>
                </div>
            </div>

            <div class="w-full p-2">
                <div v-if="props.product?.quantity > 0" class="justify-start items-center gap-3 flex w-full">
                    <!-- <button
                        class="cursor-pointer w-10 h-10 bg-white rounded-[10px] border border-primary-100 justify-center items-center flex"
                        @click="addToBasket(props.product)">
                        <img :src="'/assets/icons/bag-active.svg'" loading="lazy" class="w-5 h-5">
                    </button> -->

                    <button
                        class="justify-center items-center gap-0.5 flex border border-primary grow py-2.5 rounded-[10px]"
                        @click="addToBasket(props.product)">
                        <div class="text-primary text-sm font-normal leading-tight">{{ $t('Add to Cart') }}</div>
                    </button>
                </div>
                <!-- <button v-else
                    class="justify-center items-center gap-0.5 flex border border-red-300 py-2.5 rounded-[10px] w-full"
                    disabled>
                    <div class="text-red-300 text-sm font-normal leading-tight">
                        {{ $t('Buy Now') }}
                    </div>
                </button> -->
            </div>
        </div>
    </div>
</template>

<script setup>
import { useToast } from 'vue-toastification';
import { useBaskerStore } from '../stores/BasketStore';
import { useMaster } from '../stores/MasterStore';
import { StarIcon, HeartIcon } from '@heroicons/vue/24/solid';
import { HeartIcon as HeartIconOutline, EyeIcon } from '@heroicons/vue/24/outline';
import { TiBatteryFull } from "react-icons/ti";

import { useAuth } from '../stores/AuthStore';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

import DrivingRangeIcon from './drivingRange.svg';

const router = useRouter();

const masterStore = useMaster();

const baskerStore = useBaskerStore();
const authStore = useAuth();

const toast = useToast();

const props = defineProps({
    product: Object
});

const orderData = {
    product_id: props.product?.id,
    quantity: 1,
    size: null,
    color: null,
    unit: null
};

const addToBasket = (product) => {
    // add product to basket
    baskerStore.addToCart(orderData, product);
};
const openPdf = () => {
    const pdfUrl = props.product?.pdf_file; // Dynamically fetch the PDF URL from product data
    if (pdfUrl) {
        window.open(pdfUrl, '_blank'); // Open PDF in a new tab
    } else {
        toast.error('PDF file not available for this product.', {
            position: "bottom-left",
        });
    }
};


const buyNow = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    baskerStore.buyNowProduct = props.product;
    router.push({ name: 'buynow' })
};

const isFavorite = ref(props.product?.is_favorite);
// console.log(props.product,'here it is ')

const favoriteAddOrRemove = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    axios.post('/favorite-add-or-remove', {
        product_id: props.product.id
    }, {
        headers: {
            Authorization: authStore.token
        }
    }).then((response) => {
        props.product.is_favorite = !props.product.is_favorite
        isFavorite.value = response.data.data.product.is_favorite
        if (isFavorite.value === false) {
            toast.warning('Product removed from favorite', {
                position: "bottom-left",
            });
        } else {
            toast.success('Product added to favorite', {
                position: "bottom-left",
            });
        }
        authStore.favoriteRemove = true
        authStore.fetchFavoriteProducts();
    });
}

const showProductDetails = () => {
    if (props.product.quantity > 0) {
        router.push({ name: 'productDetails', params: { id: props.product.id } })
    }
}

</script>
