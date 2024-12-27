<template>
    <div class="main-container">

        <div class="grid grid-cols-1 xl:grid-cols-4">

            <div class="xl:col-span-3 col-span-1 lg:pr-6">

                <div class="flex items-center gap-2 overflow-hidden pt-4">
                    <router-link to="/" class="w-6 h-6">
                        <HomeIcon class="w-5 h-5 text-slate-600" />
                    </router-link>

                    <div class="grow w-full overflow-hidden">
                        <div class="space-x-1 text-slate-600 text-sm font-normal truncate">
                            <router-link to="/">{{ $t('Home') }}</router-link>
                            <span>/</span>
                            <span>{{ product.name }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap lg:flex-nowrap gap-4 mt-6">
                    <div class="lg:w-[480px] w-full">

                        <div class="w-full">
                            <div class="bg-slate-50 rounded-xl border border-slate-100 px-6">
                                <swiper :spaceBetween="10" :thumbs="{ swiper: thumbsSwiper }" :modules="modules"
                                    class="product-details-slider">
                                    <swiper-slide v-for="thumbnail in product.thumbnails" :key="thumbnail.id"
                                        class="max-h-[448px] h-auto">
                                        <img :src="thumbnail.thumbnail" alt="" class="h-full w-full object-contain">
                                    </swiper-slide>
                                </swiper>
                            </div>
                            <div class="px-1 mt-2">
                                <swiper @swiper="setThumbsSwiper" :spaceBetween="10" :slidesPerView="4" :freeMode="true"
                                    :navigation="true" :watchSlidesProgress="true" :modules="modules"
                                    class="product-details-thumbnail">
                                    <swiper-slide v-for="thumbnail in product.thumbnails" :key="thumbnail.id">
                                        <img :src="thumbnail.thumbnail" alt="" class="h-full w-full object-cover">
                                    </swiper-slide>
                                </swiper>
                            </div>

                        </div>

                    </div>

                    <div class="">
                        <div>
                            <span
                                v-for="(category, index) in product.categories || ['Uncategorized']"
                                :key="index"
                                class="text-primary text-xs font-normal leading-none px-1.5 py-1 bg-primary-50 rounded"
                            >
                                {{ category }}
                            </span>
                        </div>
                        
                    

                        <!-- Title -->
                        <div class="mt-3 text-slate-950 text-2xl font-medium leading-normal">
                            {{ product.name }}
                        </div>

                        <!-- Short Desciption -->
                        <div class="mt-2 text-slate-700 text-base font-normal leading-normal">
                            {{ product.short_description }}
                        </div>

                        <!-- Rating  review, sold and share -->
                        <!-- <div class="py-5 flex flex-wrap justify-start items-center gap-4 border-b border-slate-200">

                            <div class="w-[1px] h-4 bg-slate-200"></div>

                            <div class="text-slate-800 text-base font-normal leading-normal">
                                {{ product.total_sold }} {{ $t('Sold') }}
                            </div>

                            <div class="w-[1px] h-4 bg-slate-200"></div>
                            <button class="border-none" @click="favoriteAddOrRemove">
                                <HeartIcon v-if="!product.is_favorite" class="w-6 h-6 text-slate-600" />
                                <HeartIconFill v-else class="w-6 h-6 text-red-500" />
                            </button>
                        </div> -->

                        <!-- Price part -->
                        <div class="flex items-center gap-3 py-4 border-b border-slate-200 flex-wrap">
                            <!-- discount Price -->
                            <div class="text-primary text-3xl font-bold leading-9">
                                {{ masterStore.showCurrency(product.discount_price > 0 ? product.discount_price: product.price) }}
                            </div>

                            <!-- Price -->
                            <div v-if="product.discount_price > 0"
                                class="text-slate-400 text-2xl font-normal line-through leading-loose">
                                {{ masterStore.showCurrency(product.price) }}
                            </div>

                            <!-- discount -->
                            <div v-if="product.discount_percentage"
                                class="px-2 py-1 bg-red-500 rounded-2xl text-white text-base font-medium">
                                {{ product.discount_percentage }}% {{ $t('OFF') }}
                            </div>
                        </div>


                    

                        <div class="flex flex-wrap gap-4">
                            <!-- Quantity Increase Or Decrease -->
                        <button v-if="cartService"
                            disabled
                            class="grow max-w-56 justify-center items-center text-black flex gap-2  px-6 py-4 rounded-[10px] border border-black"
                            >
                            <img :src="'/assets/icons/bag-active.svg'" loading="lazy" class="w-5 h-5">
                            <div class="text-base font-medium leading-normal" >
                                {{ $t('Added to Cart') }}
                            </div>
                        </button>

                            <!-- Add to Cart -->
                            <button v-if="!cartService"
                                class="grow max-w-56 justify-center items-center text-primary flex gap-2  px-6 py-4 rounded-[10px] border border-primary"
                                @click="addToCart">
                                <img :src="'/assets/icons/bag-active.svg'" loading="lazy" class="w-5 h-5">
                                <div class="text-base font-medium leading-normal">
                                    {{ $t('Add to Cart') }}
                                </div>
                            </button>

                    

                            <!-- Buy Now -->
                            <!-- <button
                                class="grow text-white bg-primary px-6 py-4 rounded-[10px] border border-primary max-w-[50%]"
                                @click="buyNow">
                                <span class="text-base font-medium leading-normal">
                                    {{ $t('Order Now') }}
                                </span>
                            </button> -->
                        </div>

                    </div>
                </div>

                <div class="block xl:hidden w-full pt-6 border-slate-200">
                    <ServiceDetailsRightSide :product="product" :serviceProducts="popularServices" />
                </div>

                <div class="flex items-center gap-8 flex-wrap border-b mt-3 mb-4 xl:my-6">

                    <button class="py-3 transition text-base font-medium leading-normal border-b"
                        :class="aboutService ? 'text-primary border-primary' : 'text-slate-600 border-transparent'"
                        @click="aboutService = true; review = false">
                        {{ $t('About Service') }}
                    </button>
<!-- 
                    <button class="py-3 transition text-base font-medium leading-normal border-b"
                        :class="review ? 'text-primary border-primary' : 'text-slate-600 border-transparent'"
                        @click="showReview()">
                        {{ $t('Reviews') }}
                    </button> -->
                </div>

                <!-- About Product -->
                <div v-if="aboutService" class="">
                    <div v-html="product.description"></div>
                </div>

                <!-- Reviews -->
                <div v-if="review" class="">
                    <div class="text-slate-950 text-lg lg:text-2xl font-medium leading-loose mb-4">
                        {{ $t('Rating and Review') }}
                    </div>

                    <!-- Review Rating percentage -->
                    <div class="max-w-2xl">
                        <ReviewRatings :reviewRatings="avarageRatings.percentages"
                            :avarageRating="avarageRatings?.rating" :totalReview="avarageRatings.total_review" />
                    </div>

                    <!-- Reviews -->
                    <div class="border-t border-slate-200 mt-6">
                        <div class="mt-4 lg:mt-6 text-slate-950 text-lg lg:text-2xl font-medium leading-loose">
                            {{ $t('Reviews') }}
                        </div>

                        <div class="space-y-6 mt-6">
                            <Review v-for="review in reviews" :key="review.id" :review="review" />
                        </div>

                        <!-- paginations -->
                        <div class="flex justify-between items-center w-full mt-8  gap-4 flex-wrap">
                            <div class="text-slate-800 text-base font-normal leading-normal">
                                {{ $t('Showing') }} {{ perPage * (currentPage - 1) + 1 }} {{ $t('to') }} {{ perPage * (currentPage - 1) +
                                    reviews.length }} {{ $t('of') }} {{ totalReviews }} {{ $t('results') }}
                            </div>
                            <div>
                                <vue-awesome-paginate :total-items="totalReviews" :items-per-page="perPage"
                                    type="button" :max-pages-shown="3" v-model="currentPage"
                                    :hide-prev-next-when-ends="true"
                                    @click="onClickHandler" />
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Right side -->
            <div
                class="hidden xl:block col-span-1 w-full pt-6 h-full xl:pt-6 xl:pl-8 xl:border-l border-slate-200 xl:pb-6">
                <ServiceDetailsRightSide :product="product" :serviceProducts="popularServices" />
            </div>

        </div>

        <!-- Similar Products -->
        <div class="mt-4 xl:mt-6 text-slate-800 text-lg md:text-2xl lg:text-3xl font-bold leading-9">
            {{ $t('Similar Services') }}
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-5  gap-3 sm:gap-6 items-start my-6">
            <div v-for="product in relatedServices" :key="product.id">
                <ServiceCard :product="product" />
            </div>
        </div>


    </div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router';
import { useMaster } from '../stores/MasterStore';
import ProductDetailsRightSide from '../components/ProductDetailsRightSide.vue';
import ServiceDetailsRightSide from '../components/ServiceDetailsRightSide.vue';
import ToastSuccessMessage from '../components/ToastSuccessMessage.vue';

import { HomeIcon, ShareIcon, HeartIcon, MinusIcon, PlusIcon } from '@heroicons/vue/24/outline';
import { StarIcon, HeartIcon as HeartIconFill } from '@heroicons/vue/24/solid';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { FreeMode, Navigation, Thumbs } from 'swiper/modules';

import ReviewRatings from '../components/ReviewRatings.vue';
import Review from '../components/Review.vue';
import ProductCard from '../components/ProductCard.vue';
import ServiceCard from '../components/ServiceCard.vue';
import { useBaskerStore } from '../stores/BasketStore';
import { useServiceStore } from '../stores/ServiceStore';
import { useAuth } from '../stores/AuthStore';

import VueCountdown from '@chenfengyuan/vue-countdown';
const time = ref(7 * 60 * 60 * 1000);
// const time = ref(30 * 24 * 60 * 60 * 1000);
// const end = ref(new Date().getTime() + time.value);

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';

import { useToast } from 'vue-toastification';
const toast = useToast();

const thumbsSwiper = ref(null);

const modules = [FreeMode, Navigation, Thumbs];

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper;
};

const route = useRoute();
const router = useRouter();
const masterStore = useMaster();
const basketStore = useBaskerStore();
const serviceStore = useServiceStore();
const authStore = useAuth();

console.log("Basket store ", basketStore);
console.log("Service store ", serviceStore);

const formData = ref({
    service_id: route.params.id,
});

const product = ref({});
const relatedServices = ref([]);
const popularServices = ref([]);

const aboutService = ref(true);
const review = ref(false);

const cartService = ref(null);



onMounted(() => {
    fetchServiceDetails();
    window.scrollTo(0, 0);
    findServiceInCart(route.params.id);
});

const buyNow = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    serviceStore.buyNowProduct = product.value;
    serviceStore.buyNowProduct.size = formData.value.size;
    serviceStore.buyNowProduct.color = formData.value.color;
    router.push({ name: 'buynow' })
};

watch(route, () => {
    fetchServiceDetails();
    aboutService.value = true;
    review.value = false;
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
    formData.value.service_id = route.params.id;
    findServiceInCart(route.params.id);
});

const findServiceInCart = (serviceId) => {
    let foundService = null;
    console.log("Cart service ", serviceStore.services);
    serviceStore.services.forEach((item) => {
            if (item.service.id == serviceId) {
                return foundService = product;
            }
    });
    cartService.value = foundService;
    // if (foundService) {
    //     formData.value.size = foundService.size;
    //     formData.value.color = foundService.color;
    //     formData.value.unit = foundService.unit;
    // }
}

const addToCart = () => {
    serviceStore.addToCart(formData.value, product.value)
    setTimeout(() => {
        findServiceInCart(route.params.id);
    }, 500);
}

const decrementQty = () => {
    basketStore.decrementQuantity(product.value);
    setTimeout(() => {
        findServiceInCart(route.params.id);
    }, 500);
}

const incrementQty = () => {
    basketStore.incrementQuantity(product.value);
    setTimeout(() => {
        findServiceInCart(route.params.id);
    }, 500);
}

const favoriteAddOrRemove = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    axios.post('/favorite-add-or-remove', {
        service_id: product.value.id
    }, {
        headers: {
            Authorization: authStore.token
        }
    }).then(() => {
        product.value.is_favorite = !product.value.is_favorite
        if (product.value.is_favorite === false) {
            const content = {
                component: ToastSuccessMessage,
                props: {
                    title: 'Product removed from favorite',
                    message: 'Product removed from favorite successfully',
                },
            };
            toast(content, {
                type: "default",
                hideProgressBar: true,
                icon: false,
                position: "top-right",
                toastClassName: "vue-toastification-alert",
                timeout: 3000
            });
        } else {
            const content = {
                component: ToastSuccessMessage,
                props: {
                    title: 'Product added to favorite',
                    message: 'Product added to favorite successfully',
                },
            };
            toast(content, {
                type: "default",
                hideProgressBar: true,
                icon: false,
                position: "top-right",
                toastClassName: "vue-toastification-alert",
                timeout: 3000
            });
        }
        authStore.fetchFavoriteProducts();
    }).catch((error) => {
        console.log(error);
    });
}

const showReview = () => {
    aboutService.value = false;
    review.value = true;
    fetchReviews();
}

const fetchServiceDetails = async () => {
    axios.get('/service-details', {
        params: { service_id: route.params.id },
        headers: {
            Authorization: authStore.token,
        }
    }).then((response) => {
        product.value = response.data.data.product;
        console.log(product.value);
        relatedServices.value = response.data.data.related_products;
        popularServices.value = response.data.data.popular_products;

        findServiceInCart(route.params.id);
    })
};

const avarageRatings = ref({});

const totalReviews = ref(0);
const reviews = ref([]);

const currentPage = ref(1);
const perPage = ref(6);

const onClickHandler = (page) => {
    currentPage.value = page;
    fetchReviews();
};

const fetchReviews = async () => {
    axios.get('/reviews', { params: { service_id: route.params.id, page: currentPage.value, per_page: perPage.value } }).then((response) => {
        totalReviews.value = response.data.data.total;
        reviews.value = response.data.data.reviews;
        avarageRatings.value = response.data.data.average_rating_percentage;
    })
};

</script>

<style>
.product-details-slider .swiper-slide {
    height: auto !important;
}

.product-details-thumbnail .swiper-slide {
    @apply h-20 md:h-[120px] lg:h-[100px];
}

.product-details-thumbnail .swiper-button-prev,
.product-details-thumbnail .swiper-button-next {
    @apply bg-white w-6 h-6 rounded-full shadow border border-slate-200 text-slate-600 -translate-y-1/2 mt-0;
}

.product-details-thumbnail .swiper-button-prev::after,
.product-details-thumbnail .swiper-button-next::after {
    @apply text-base;
}

.product-details-thumbnail .swiper-button-next {
    right: 0px;
}

.product-details-thumbnail .swiper-button-prev {
    left: 0px;
}

.product-details-thumbnail .swiper-slide {
    @apply border border-slate-100 rounded-lg transition overflow-hidden;
}

.product-details-thumbnail .swiper-slide-thumb-active {
    @apply border border-primary;
}
</style>
