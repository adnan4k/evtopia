<template>
    <div>

        <Categories :categories="categories" :loading="loading"/>

        <div class="main-container py-4 bg-slate-100">

            <div class="w-full p-2 md:p-4 bg-white rounded-lg sm:rounded-xl md:rounded-2xl flex gap-3 md:gap-6 items-center justify-between">
                <div class="w-full"> 
                    <div class="relative overflow-hidden grow">
                        <input type="text" v-model="localSearch" :placeholder="$t('Search product')"
                            class="px-2 py-2 md:py-3 block rounded-lg border border-slate-200 focus:border-primary w-full
                                 placeholder:text-gray-400 outline-none text-base font-normal leading-normal"
                                 @input="searchProducts"
                                 >
                        <button
                            class="bg-primary h-full w-10 md:w-14 border-none absolute right-0 top-0 rounded-r-lg flex items-center justify-center" @click="searchProducts()">
                            <MagnifyingGlassIcon class="w-6 h-6 text-white" />
                        </button>
                    </div>
                    
                </div>

                <!-- Filter button -->
                <div>
                    <button
                        class="p-2 sm:px-4 sm:py-3 bg-slate-200 rounded-md sm:rounded-[10px] justify-center items-center gap-2 inline-flex text-slate-600 text-sm sm:text-base font-normal leading-normal border-0 outline-none hover:text-primary transition duration-300"
                        @click="showfilterCanvas = true">
                        <FunnelIcon class="w-4 h-4 sm:w-6 sm:h-6" />
                        <div class="grow shrink basis-0">
                            {{ $t('Filter') }}
                        </div>
                    </button>
                </div>
            </div>
            <div class="grow flex justify-between items-center px-2 md:px-4 overflow-x-auto whitespace-nowrap">
                <div>
                    <span class="text-primary text-xs">“{{ search || 'all' }}”</span>
                    <span class="text-slate-800 text-xs font-normal pl-2">
                        {{ totalProducts }} {{ $t('items found') }}
                    </span>
                </div>
                <div>
                    <button class="text-red-500 text-xs" @click="resetFilters">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <AllProducts :justForYou="justForYou" :loading="loading"/>
        <PopularProducts :products="popularProducts" :loading="loading"/>
        <div v-if="master.getMultiVendor">
            <TopRatedShops :shops="topRatedShops" :loading="loading"/>
        </div>
        <RecentlyViews :products="recentlyViewProducts" :loading="loading"/>


        <!-- Filter Canvas Drawer -->
        <TransitionRoot as="template" :show="showfilterCanvas">
            <Dialog as="div" class="relative z-10" @close="showfilterCanvas = false">
                <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100"
                    leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-30 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                            <TransitionChild as="template"
                                enter="transform transition ease-in-out duration-500 sm:duration-700"
                                enter-from="translate-x-full" enter-to="translate-x-0"
                                leave="transform transition ease-in-out duration-500 sm:duration-700"
                                leave-from="translate-x-0" leave-to="translate-x-full">
                                <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                                    <TransitionChild as="template" enter="ease-in-out duration-500"
                                        enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500"
                                        leave-from="opacity-100" leave-to="opacity-0">
                                        <div class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4"></div>
                                    </TransitionChild>
                                    <div
                                        class="flex h-full flex-col justify-between overflow-y-scroll bg-white shadow-xl">
                                        <div class="p-4 flex flex-col gap-7">
                                            <div class="flex justify-between items-center">
                                                <div class="text-slate-950 text-xl font-bold leading-loose">{{ $t('Filter') }}</div>
                                                <button
                                                    class="w-8 h-8 flex justify-center items-center bg-slate-100 rounded-full"
                                                    @click="showfilterCanvas = false">
                                                    <XMarkIcon class="w-5 h-5 text-slate-700" />
                                                </button>
                                            </div>

                                            <!-- Customer Review -->
                                            <div>
                                                <div class="text-slate-950 text-base font-medium leading-normal">
                                                    {{ $t('Customer Review') }}
                                                </div>
                                                <!-- Rating -->
                                                <div class="flex flex-col gap-2 mt-3">
                                                    <div v-for="rating in ratings" :key="rating" class="grow">
                                                        <label :for="`rating${rating}`"
                                                            class="cursor-pointer has-[:checked]:border-primary text-slate-800 flex items-center justify-between px-2 py-1.5 bg-white rounded-lg border border-slate-100 gap-1.5">
                                                            <div class="flex items-center gap-1">
                                                                <div class="flex items-center">
                                                                    <StarIcon v-for="i in 5" :key="i" class="w-5 h-5"
                                                                        :class="i <= rating ? 'text-amber-500' : 'text-gray-200'" />
                                                                </div>
                                                                <div class="text-base font-medium leading-normal">
                                                                    {{ rating }}.0
                                                                </div>
                                                            </div>
                                                            <input type="radio" v-model="filterFormData.rating"
                                                                :id="`rating${rating}`" name="rating" :value="rating"
                                                                class="w-5 h-5 appearance-none checked:bg-primary rounded-full border-2 border-slate-300 shrink-0 transition duration-300" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sort by -->
                                            <div>
                                                <div class="text-slate-950 text-base font-medium leading-normal">Sort by
                                                </div>

                                                <select v-model="filterFormData.sort_by"
                                                    class="w-full mt-1 p-3 rounded bg-transparent border border-gray-100 outline-none">
                                                    <option v-for="sort_by in filterSortBy" :key="sort_by"
                                                        :value="sort_by.value">{{ sort_by.name }}</option>
                                                </select>
                                            </div>

                                            <!-- <div>
                                                <div class="flex justify-between items-center gap-2">
                                                    <div class="text-slate-950 text-base font-medium leading-normal">
                                                        {{ $t('Product') }}
                                                        Price</div>
                                                    <div class="text-primary text-base font-normal leading-normal">
                                                        {{ $t('ETB 0 - ETB 10000000') }}
                                                    </div>
                                                </div>
                                                <div class="flex mt-2">
                                                    <input type="range" min="0" max="10000000"
                                                        v-model="filterFormData.minPrice"
                                                        class="w-full rotate-180 appearance-none  bg-slate-300 accent-primary-600 focus:accent-primary h-2 rounded-r-full" />
                                                    <input type="range" min="00" max="10000000"
                                                        v-model="filterFormData.maxPrice"
                                                        class="w-full appearance-none bg-slate-300 accent-primary-600  focus:accent-primary h-2 rounded-r-full -ml-0.5" />
                                                </div>
                                                <div
                                                    class="text-slate-400 text-xs font-normal leading-none flex justify-between mt-2">
                                                    <span>
                                                        ETB {{ filterFormData.minPrice }}
                                                    </span>
                                                    <span>
                                                        ETB {{ filterFormData.maxPrice }}
                                                    </span>
                                                </div>
                                            </div> -->

                                            <div>
                                                <div class="flex justify-between items-center gap-2">
                                                    <div class="text-slate-950 text-base font-medium leading-normal">
                                                        {{ $t('Product') }} Price
                                                    </div>
                                                    <div class="text-primary text-base font-normal leading-normal">
                                                        {{ $t('ETB 0 - ETB 10000000') }}
                                                    </div>
                                                </div>
                                                <div class="flex mt-2 gap-2">
                                                    <input type="number" 
                                                           v-model="filterFormData.minPrice" 
                                                           min="0" 
                                                           max="10000000" 
                                                           placeholder="Min Price"
                                                           class="w-full bg-slate-100 text-slate-900 border border-slate-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-primary-600" />
                                                    
                                                    <input type="number" 
                                                           v-model="filterFormData.maxPrice" 
                                                           min="0" 
                                                           max="10000000" 
                                                           placeholder="Max Price"
                                                           class="w-full bg-slate-100 text-slate-900 border border-slate-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-primary-600" />
                                                </div>
                                                <div class="text-slate-400 text-xs font-normal leading-none flex justify-between mt-2">
                                                    <span>
                                                       Min Price : ETB {{ filterFormData.minPrice || 0 }}
                                                    </span>
                                                    <span>
                                                       Max Price :  ETB {{ filterFormData.maxPrice || 10000000 }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="flex gap-6 p-6 border-t border-slate-200">
                                            <button
                                             @click="clearFilters"
                                                class="grow px-4 py-3 rounded-[10px] border border-primary text-primary text-base font-medium leading-normal">
                                                {{ $t('Clear') }}
                                            </button>
                                            <button
                                                @click="applyFilters"
                                                class="grow px-4 py-3 bg-primary rounded-[10px] border border-primary text-white text-base font-medium leading-normal">
                                                {{ $t('Apply') }}
                                            </button>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

    </div>
</template>

<script setup>
import { onMounted,computed, ref, watch } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { FunnelIcon, XMarkIcon, ArrowLeftIcon } from '@heroicons/vue/24/outline';
import { StarIcon } from '@heroicons/vue/24/solid';
import ProductCard from '../components/ProductCard.vue';
import { useMaster } from '../stores/MasterStore';
import RecentlyViews from "../components/RecentlyViews.vue";
import { useAuth } from "../stores/AuthStore";
import AllProducts from "../components/AllProducts.vue";
import PopularProducts from "../components/PopularProducts.vue";
import { MagnifyingGlassIcon, EyeSlashIcon, EyeIcon } from '@heroicons/vue/24/solid'
import TopRatedShops from "../components/TopRatedShops.vue";
import Categories from "../components/Categories.vue";

const master = useMaster();
const recentlyViewProducts = ref([]);
const authStore = useAuth();
const justForYou = ref([]);
const topRatedShops = ref([]);

onMounted(() => {
    localSearch.value = master.search || '';
    getData();
    fetchProducts();
    fetchViewProducts();
    window.scrollTo(0, 0);
});
const localSearch = ref('');
const search = computed(() => localSearch.value || master.search || '');


watch(() =>search, () => {
        fetchProducts();
});

watch(() => master.search, () => {
    localSearch.value = master.search || '';
    fetchProducts();

});



const currentPage = ref(1);
const perPage = 12;

const onClickHandler = (page) => {
    currentPage.value = page;
    fetchProducts();
};

const fetchViewProducts = () => {
    if (authStore.token) {
        axios.get('/recently-views', {
            headers: {
                Authorization: authStore.token
            }
        }).then((response) => {
            recentlyViewProducts.value = response.data.data.products;
        }).catch(() => {});
    }
}

const showfilterCanvas = ref(false);

const filterFormData = ref({
    rating: null,
    sort_by: null,
    minPrice: 0,
    maxPrice: 10000000
});



const ratings = [5, 4, 3, 2, 1];

const categories = ref([]);

const products = ref([]);
const totalProducts = ref(0);
const popularProducts = ref([]);
const loading = ref(true);

const fetchProducts = async () => {
    const params = {
        page: currentPage.value,
        per_page: perPage,
        search: search.value,
        rating: filterFormData.value.rating,
        sort_by: filterFormData.value.sort_by,
        brand: filterFormData.value.brand,
        color: filterFormData.value.color,
        min_price: filterFormData.value.minPrice,
        max_price: filterFormData.value.maxPrice,
    };

    axios.get('/products', { params }).then((response) => {
        totalProducts.value = response.data.data.total;
        products.value = response.data.data.products;
        justForYou.value = response.data.data;
    }).catch(() => {
        products.value = [];
        totalProducts.value = 0;
    }).finally(() => {
        loading.value = false;
    });
};


const applyFilters = () => {
    currentPage.value = 1; // Reset to the first page
    showfilterCanvas.value = false; // Close the filter drawer
    fetchProducts(); // Fetch products with applied filters
};

const clearFilters = () => {
    filterFormData.value = {
        rating: null,
        sort_by: null,
        minPrice: 0,
        maxPrice: 10000000
    };
    fetchProducts(); 
};


const resetFilters = () => {
    filterFormData.value = {
        rating: null,
        sort_by: null,
        minPrice: 0,
        maxPrice: 10000000
    };
    localSearch.value = '';  
    master.search = '';
    fetchProducts(); 
};

const searchProducts = () => {
    if (localSearch.value) {
        master.search = ''; 
    }
    currentPage.value = 1; 
    fetchProducts();
};
const fetchCategories = async () => {
    if (categories.value.length === 0) {
        axios.get('/categories').then((response) => {
            categories.value = response.data.data.categories;
        });
    }
};

const getData = () => {
    axios.get('/home?page=1&per_page=12', {
        headers: {
            Authorization: authStore.token
        }
    }).then((response) => {
        popularProducts.value = response.data.data.popular_products;
        topRatedShops.value = response.data.data.shops.slice(0, 4);
        categories.value = response.data.data.categories;

    }).catch(() => {}).
    finally(() => {
        loading.value = false;
    });

    // fetch categories
    axios.get('/categories').then((response) => {
        master.categories = response.data.data.categories;
    }).catch(() => {}).
    finally(() => {
        loading.value = false;
    });
}

const filterSortBy = [
    {
        name: 'High to Low',
        value: 'high_to_low'
    },
    {
        name: 'Low to High',
        value: 'low_to_high'
    },
    {
        name: 'Popular Product',
        value: 'popular_product'
    },
    {
        name: 'Top Selling',
        value: 'top_selling'
    },
    {
        name: 'New Product',
        value: 'newest'
    }
];

</script>

<style>

input[type=range]::-webkit-slider-runnable-track,
input[type=range]::-ms-track,
input[type=range]::-moz-range-track {
    background: #000;
}

input[type=range]::-moz-range-thumb,
input[type=range]::-ms-thumb,
input[type=range]::-webkit-slider-thumb {
    background: #000;
}
</style>
