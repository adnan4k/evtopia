<template>
    <div class="main-container">

        <div class="grid grid-cols-1 xl:grid-cols-2">

            <div class="xl:col-span-3 col-span-1 lg:pr-6">

                <div class="flex items-center gap-2 overflow-hidden pt-4">
                    <router-link to="/" class="w-6 h-6">
                        <HomeIcon class="w-5 h-5 text-slate-600" />
                    </router-link>

                    <div class="grow w-full overflow-hidden">
                        <div class="space-x-1 text-slate-600 text-sm font-normal truncate">
                            <router-link to="/">{{ $t('Home') }}</router-link>
                            <span>/</span>
                            <span>{{ post.title }}

                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col  gap-10 md:flex-row">

                    <div class="w-full md:w-3/4 flex flex-col gap-6 mt-6 mb-10">
                        <div  v-if="post.banner" class="w-full relative">

                            <img class="w-full h-96 object-cover transition duration-300"
                            :src="post?.banner" alt="banner" loading="lazy" />
                        </div>

                        <div>
                            <div>
                                <span class="text-slate-400 text-xs font-normal leading-none">
                                  Posted by {{ post?.author?.name }},
                                </span>
                                <span class="text-slate-400 text-xs font-normal leading-none">
                                    {{ post.created_at }}
                                </span>
                            </div>
                            <div class="text-slate-950 font-[roboto] text-2xl font-bold leading-normal">
                                {{ post.title }}
                            </div>
                        </div>

                        <p class="text-slate-700 text-base font-normal leading-normal">
                            {{ post.short_description }}
                        </p>

                        <p v-html="post.description" class="text-slate-700 text-justify text-base font-normal leading-normal">

                        </p>

                        <!-- Video Section -->
                        <div v-if="post.video_links && post.video_links.length > 0" class="video-section">
                            <!-- <h2 class="text-lg font-bold">Videos</h2> -->
                            <div class="video-grid">
                                <div v-for="(video, index) in post.video_links" :key="index" class="video-item">
                                    <div class="video-container">
                                        <iframe 
                                            :src="'https://www.youtube.com/embed/' + video" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div v-if="post.images && post.images.length > 0" class="video-section">
                            <h2 class="text-lg font-bold py-5">Gallery </h2>
                            <div class="video-grid">
                                <div v-for="(image, index) in post.images" :key="index" class="video-item">
                                    <div class="video-container">
                                        <img class="object-cover transition duration-300"
                                        :src="image" alt="banner" loading="lazy" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>

                    <div class="md:w-1/4 w-full col-span-12 mt-2 mb-10">
                        <!-- Search input here -->

                        <div class="w-full bg-white rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3">
                            <div class="relative overflow-hidden grow">
                                <input type="text" v-model="search" :placeholder="$t('Search Blog')"
                                    class="px-2 py-3 block rounded-lg border border-slate-200 focus:border-primary
                                    w-full placeholder:text-gray-400 outline-none text-base font-normal leading-normal">
                                <button
                                    class="bg-primary-600 h-full w-14 border-none absolute right-0 top-0 rounded-r-lg flex items-center justify-center"
                                    @click="searchBlogs">
                                    <MagnifyingGlassIcon class="w-6 h-6 text-white" />
                                </button>
                            </div>
                        </div>

                        <div class="w-full bg-white rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3 sticky top-32">
                            <!-- Resources / PDFs Section -->
                            <div v-if="post.pdfs && post.pdfs.length > 0" class="mb-4">
                                <h1 class="text-slate-950 font-[roboto] text-xl font-bold leading-normal">{{ $t('Resources / PDFs') }}</h1>
                                <div v-for="pdf in post.pdfs" :key="pdf.id" class="w-full my-2 bg-white flex items-center gap-3 rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3">
                                    <div class="w-full">
                                        <div class="text-slate-950 font-[roboto] text-sm font-bold leading-normal">
                                            <a :href="pdf.url" download class="text-blue-600 hover:underline">
                                                {{ pdf.name.length > 50 ? pdf.name.slice(0, 50) + '...' : pdf.name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="relatedBlogs && relatedBlogs.length>0" class="w-full bg-white rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3 sticky top-32">
                           <h1 class="text-slate-950 font-[roboto] text-xl font-bold leading-normal"> {{ $t('Related Contents') }}</h1>
                            <div v-for="blog in relatedBlogs" :key="blog.id" class="w-full shrink-0">
                                <div class="w-full bg-white flex items-center gap-3 rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3">
                                    <router-link :to="`/knowledge-center/${blog.slug}`" class="w-32 h-24 ">
                                        <img class="w-32 h-24 object-contain transition duration-300" :src="blog?.banner" alt="banner" loading="lazy" />
                                    </router-link>
                                    <div class="w-full">
                                        <div class="text-slate-950 font-[roboto] text-sm font-bold leading-normal">
                                            <router-link :to="`/knowledge-center/${blog?.slug}`" >
                                                {{ blog?.title.length > 80 ? blog.title.slice(0, 80) + '...' : blog.title }}
                                            </router-link>
                                        </div>
                                    </div>
                                </div>
                            </div
                        </div>

                        <!-- <div class="w-full bg-white rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3">
                            <h1 class="text-slate-950 font-[roboto] py-1 text-xl font-bold leading-normal">{{ $t('Categories') }}</h1>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="category in post.categories" :key="category.id" class="bg-primary text-white font-[roboto] text-xs font-bold leading-normal px-2 py-1 rounded-md">
                                    <router-link :to="`/blog?category_id=${category.id}`">
                                        {{ category?.name.length > 120 ? category.name.slice(0, 120) + '...' : category.name }}
                                    </router-link>
                                </span>
                            </div>
                        </div> -->


                        <!-- <div class="w-full bg-white rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3">
                            <h1 class="text-slate-950 font-[roboto] py-1 text-xl font-bold leading-normal">{{ $t('Tags') }}</h1>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="tag in post.tags" :key="tag.id" class="bg-primary text-white font-[roboto] text-xs font-bold leading-normal px-2 py-1 rounded-md">
                                    <router-link :to="`/blog?tag_id=${tag.id}`">
                                        {{ tag?.name.length > 120 ? tag.name.slice(0, 120) + '...' : tag.name }}
                                    </router-link>
                                </span>
                            </div>
                        </div> -->

                        </div>
                        </div>
                    </div>
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
import { MagnifyingGlassIcon, EyeSlashIcon, EyeIcon } from '@heroicons/vue/24/solid'

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

const formData = ref({
    post_id: route.params.id,
});

const product = ref({});
const post = ref({});
const relatedServices = ref([]);
const relatedBlogs = ref([]);
const popularServices = ref([]);

const aboutService = ref(true);
const review = ref(false);

const cartService = ref(null);
const search = ref('');


onMounted(() => {
    fetchBlogDetails();
    window.scrollTo(0, 0);
    findServiceInCart(route.params.id);
});


const searchBlogs = () => {
    // Redirect to /blog with the search query
    if (search.value) {
        router.push({ path: '/blog', query: { search: search.value } });
    }
};
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
    fetchBlogDetails();
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
    });
}

const showReview = () => {
    aboutService.value = false;
    review.value = true;
    fetchReviews();
}

const fetchBlogDetails = async () => {
    axios.get('/blog-details', {
        params: { post_id: route.params.id, knowledge : 1},
        headers: {
            Authorization: authStore.token,
        }


    }).then((response) => {
        post.value = response.data.data.post;
        relatedBlogs.value = response.data.data.related_posts;
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

.video-section {
    padding: 0px ;
}

.video-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); /* Responsive grid */
}

.video-item {
    display: flex;
    justify-content: center;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    width: 100%;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

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
