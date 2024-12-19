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

                        <div>
                            <div class="text-slate-950 text-base font-normal leading-normal truncate w-full"
                                :class="props.product?.quantity > 0 ? '' : 'opacity-30'">
                                {{ props.product?.name }} 
                               
                            </div>
    
                            <div v-if="props.product?.model">
                                <span class="text-muted text-xs">
                                    Model : {{props.product?.model}}
                                </span>
                            </div>
                        </div>
                        <div class="flex justify-between gap-2" :class="props.product?.quantity > 0 ? '' : 'opacity-30'">
                            <!-- price -->


                               <!--discount--->



                        </div>

                        <div class="flex justify-between items-center w-full">



                            <div class="flex items-center gap-2">
                                <div class="text-primary text-base font-bold leading-normal">
                                    {{ masterStore.showCurrency(props.product?.discount_price > 0 ? props.product?.discount_price : props.product?.price) }}
                                </div>
                                <!-- discount price -->
                                <div v-if="props.product?.discount_price > 0"
                                    class="text-slate-400 text-sm font-normal line-through leading-tight">
                                    {{ masterStore.showCurrency(props.product?.price) }}
                                </div>

                            </div>




                            <div v-if="props.product?.is_special"
                                >
                                    🔥
                            </div>
                        </div>

                        <div class="flex justify-between items-center w-full">
                            <!-- <div class="flex items-center gap-1"
                                :class="props.product?.quantity > 0 ? '' : 'opacity-30'">
                                <StarIcon class="w-4 h-4 text-yellow-400" />
                                <div class="text-slate-950 text-sm font-bold leading-tight">
                                    {{ props.product?.rating }}
                                </div>
                                <div class="text-slate-500 text-sm font-normal leading-tight">
                                    ({{ props.product?.total_reviews }})
                                </div>
                            </div> -->

                            <div v-if="props.product?.year" class="flex items-center gap-1"
                            >
                            <div class="text-slate-950 text-sm font-bold leading-tight">
                                {{ props.product?.year }}
                            </div>

                        </div>

                            <div  v-if="props.product?.year" class="h-3 w-[0px] border border-slate-300"></div>
                            <!-- total sold -->


                            <div v-if="props.product?.transmission" class="flex items-center gap-1"
                               >
                                <!-- rating -->
                                <div class="text-slate-950 text-sm font-bold leading-tight">
                                    {{ props.product?.transmission }}
                                </div>

                            </div>

                            <div v-if="props.product?.transmission" class="h-3 w-[0px] border border-slate-300"></div>

                            <div v-if="props.product?.drive_train"  class="flex items-center gap-1"
                            >
                             <!-- rating -->
                             <div class="text-slate-950 text-sm font-bold leading-tight">
                                 {{ props.product?.drive_train }}
                             </div>

                         </div>
                        </div>



                        <div class="flex justify-between items-center w-full">

                            <div v-if="props.product?.mileage" class="flex items-center gap-1"
                               >
                                <!-- rating -->
                                <div  class="text-slate-950 text-sm font-bold leading-tight">
                                    {{ props.product?.mileage }} KM
                                </div>

                            </div>
                            <div v-if="props.product?.mileage" class="h-3 w-[0px] border border-slate-300"></div>

                            <div class="flex items-center gap-1"
                                :class="props.product?.quantity > 0 ? '' : 'opacity-30'">
                                <StarIcon class="w-4 h-4 text-yellow-400" />
                                <!-- rating -->
                                <div class="text-slate-950 text-sm font-bold leading-tight">
                                    {{ props.product?.rating }}
                                </div>
                                <!-- Total Review -->
                                <div class="text-slate-500 text-sm font-normal leading-tight">
                                    ({{ props.product?.total_reviews }})
                                </div>
                            </div>

                            <div class="h-3 w-[0px] border border-slate-300"></div>
                            <!-- total sold -->
                            <div v-if="props.product?.quantity > 0"
                                class="text-right text-slate-500 text-sm font-normal leading-tight">
                                {{ props.product?.total_sold }} {{ $t('Sold') }}
                            </div>
                            <!-- Stock Out -->
                            <div v-else class="text-right text-red-500 text-sm font-normal leading-tight">
                                {{ $t('Stock Out') }}
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
                        class="justify-center items-center gap-0.5 flex border border-primary grow py-2.5 rounded-[10px]" @click="addToBasket(props.product)">
                        <div class="text-primary text-sm font-normal leading-tight">{{ $t('Add to Cart') }}</div>
                    </button>
                </div>
                <button v-else
                    class="justify-center items-center gap-0.5 flex border border-red-300 py-2.5 rounded-[10px] w-full" disabled>
                    <div class="text-red-300 text-sm font-normal leading-tight">
                        <!-- Request Stock -->
                        {{ $t('Buy Now') }}
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useToast } from 'vue-toastification';
import { useBaskerStore } from '../stores/BasketStore';
import { useMaster } from '../stores/MasterStore';
import { StarIcon, HeartIcon } from '@heroicons/vue/24/solid';
import { HeartIcon as HeartIconOutline } from '@heroicons/vue/24/outline';
import { useAuth } from '../stores/AuthStore';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

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

const buyNow = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    baskerStore.buyNowProduct = props.product;
    router.push({ name: 'buynow' })
};

const isFavorite = ref(props.product?.is_favorite);

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
    if(props.product.quantity > 0) {
        router.push({ name: 'productDetails', params: { id: props.product.id } })
    }
}

</script>
