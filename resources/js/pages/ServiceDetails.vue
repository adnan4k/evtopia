<template>
    <div class="">

         <!-- shimmmer  -->
            <div v-if="loading" class="main-container space-y-6 animate-pulse py-8">
                <!-- Breadcrumbs skeleton -->
                <div class="flex items-center gap-2 pt-4">
                    <div class="w-6 h-6 bg-slate-200 rounded"></div>
                    <div class="flex-1 h-4 bg-slate-200 rounded"></div>
                </div>

                <!-- Hero slider skeleton -->
                <div class="w-full h-96 bg-slate-200 rounded-xl"></div>
                <div class="grid grid-cols-4 gap-2">
                    <div v-for="i in 4" :key="i" class="h-24 bg-slate-200 rounded"></div>
                </div>

                <!-- Title & model skeleton -->
                <div class="space-y-2 lg:pl-6">
                    <div class="h-8 bg-slate-200 rounded w-1/2"></div>
                    <div class="h-4 bg-slate-200 rounded w-1/4"></div>
                </div>

                <!-- Short description skeleton -->
                <div class="h-4 bg-slate-200 rounded w-full"></div>
                <div class="h-4 bg-slate-200 rounded w-5/6"></div>

                <!-- Stats row skeleton (range, battery, year) -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div v-for="i in 3" :key="i" class="h-6 bg-slate-200 rounded"></div>
                </div>

                <!-- Price & discount skeleton -->
                <div class="flex items-center gap-4">
                    <div class="h-10 bg-slate-200 rounded w-32"></div>
                    <div class="h-6 bg-slate-200 rounded w-20"></div>
                </div>

                <!-- Action buttons skeleton -->
                <div class="flex gap-4">
                    <div class="h-10 bg-slate-200 rounded flex-1"></div>
                    <div class="h-10 bg-slate-200 rounded flex-1"></div>
                </div>

                <!-- Related products heading skeleton -->
                <div class="mt-6 h-6 bg-slate-200 rounded w-1/4"></div>

                <!-- Related products grid skeleton -->
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-3">
                    <div v-for="i in 5" :key="i" class="h-48 bg-slate-200 rounded"></div>
                </div>
            </div>
            <div v-else > 
                <div class="hero flex flex-col md:flex-row justify-center gap-4 md:justify-between  items-center px-5 md:px-10 lg:px-20 bg-primary h-40">
                    <div class="text-white text-center md:text-left text-xl md:text-2xl font-medium leading-normal">
                        {{ product.name }}
                    </div>
                    <div>
                        <button @click="openContactModal" class="px-3 py-2 bg-white text-primary text-sm font-medium leading-none rounded">
                            Contact for Service
                        </button>
                    </div>
                </div>
                
                <div class="main-container ">

                    <div class="px-2 md:px-8 grid grid-cols-1 xl:grid-cols-4 mt-10">
            
            
                        <div class="xl:col-span-3 col-span-1 lg:pr-6">
            
                            <div class="flex flex-wrap lg:flex-nowrap gap-4 md:pr-10 mt-6">
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
            
                                    <div class="w-full flex md:pr-10 border border-slate-300 rounded-lg py-3 px-3 items-center justify-between mt-3">
                                        <h1>
                                            Do you need this service?
                                        </h1>

                                        <button @click="openContactModal"  class="px-3 py-2 bg-primary text-white text-sm font-medium leading-none rounded">
                                            Contact Evtopia
                                        </button>
                                    </div>
                                   
                                </div>
                            </div>
                            <div v-if="aboutService" class=" mt-6">
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
            
                            <div class="w-full my-12 flex md:pr-10 border border-slate-300 rounded-lg py-3 px-3 items-center justify-between mt-3">
                                        <h1>
                                            Do you need this service?
                                        </h1>

                                        <button @click="openContactModal"  class="px-3 py-2 bg-primary text-white text-sm font-medium leading-none rounded">
                                            Contact Evtopia
                                        </button>
                                    </div>
                        </div>
            
                        <!-- Right side -->
                        <div
                            class="">
                            <!-- <ServiceDetailsRightSide :product="product" :serviceProducts="popularServices" /> -->
    
                                <div class=" w-full">
            
                                    <div class="w-full ">
                                        <div class="bg-slate-50 rounded-xl border border-slate-100">
                                            <swiper :spaceBetween="10" :thumbs="{ swiper: thumbsSwiper }" :modules="modules"
                                                class="product-details-slider">
                                                <swiper-slide v-for="thumbnail in product.thumbnails" :key="thumbnail.id"
                                                    class="w-full h-auto">
                                                    <img :src="thumbnail.thumbnail" alt="" class="h-full w-full object-contain">
                                                </swiper-slide>
                                            </swiper>
                                        </div>

                                         <div class="mt-4 xl:mt-6 text-slate-800 text-lg md:text-2xl  font-bold leading-9">
                                            {{ $t('Similar Services') }}
                                        </div>
                                
                                        <div class=" gap-3 sm:gap-6 items-start mt-4 mb-6">
                                            <div v-for="product in relatedServices" :key="product.id">
                                                <div class="w-full card gap-4 flex border-b border-slate-200 pb-2 cursor-pointer" @click="showServiceDetails">
                                                    <img :src="product.thumbnail" alt="" class="w-32 rounded-lg object-contain">
                                                    <div>
                                                        <div >
                                                            <h1>{{ product.name }}</h1>
                                                            <span
                                                                v-for="(category, index) in product.categories || ['Uncategorized']"
                                                                :key="index"
                                                                class="text-primary text-xs font-normal leading-none px-1.5 py-1 bg-primary-50 rounded"
                                                            >
                                                                {{ category }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          
            
                                    </div>
            
                                </div>
                        </div>
            
                    </div>


                    
            
                   
                </div>

            </div>

            <!-- <div class="px-5 md:px-24 py-5">
                <ContactUs />

            </div> -->

        <PopularProducts :products="popularProducts"  :loading="loading"/>



    </div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router';
import { useMaster } from '../stores/MasterStore';
import ProductDetailsRightSide from '../components/ProductDetailsRightSide.vue';
import ServiceDetailsRightSide from '../components/ServiceDetailsRightSide.vue';
import ToastSuccessMessage from '../components/ToastSuccessMessage.vue';
import PopularProducts from "../components/PopularProducts.vue";

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
import ContactUs from '../components/ContactUs.vue';

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
const loading = ref(true);
const popularProducts = ref([]);


const modules = [FreeMode, Navigation, Thumbs];

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper;
};

const openContactModal = () => {
  window.dispatchEvent(new Event('open-contact-popup'));
};

const route = useRoute();
const router = useRouter();
const masterStore = useMaster();
const basketStore = useBaskerStore();
const serviceStore = useServiceStore();
const authStore = useAuth();

const formData = ref({
    service_id: route.params.id,
});

const product = ref({});
const relatedServices = ref([]);
const popularServices = ref([]);

const aboutService = ref(true);
const review = ref(false);

const cartService = ref(null);


const getData = () => {
    loading.value = true;

    axios.get('/popularProducts', {
        headers: {
            Authorization: authStore.token
        }
    }).then((response) => {
        popularProducts.value = response.data.data.products;
    }).catch(() => {})
    .finally(() => {
      loading.value = false;
    });

    
}

onMounted(() => {
    fetchServiceDetails();
    window.scrollTo(0, 0);
    findServiceInCart(route.params.id);
    getData();
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
    }).finally(() => {
        loading.value = false;
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
    }).catch((error) => {
        console.error('Error fetching service details:', error);
    }).finally(() => {
        loading.value = false;
    });
};

const showServiceDetails = (  ) => {
    router.push({ name: 'serviceDetails', params: { id: product.value.id } })
}

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
