<template>
  <!-- Hero Section with Blog Image -->
  <div class="hero-section bg-cover bg-center h-72 flex items-center justify-center" 
  :style="{ backgroundImage: `url(${banner})`, backgroundSize: 'cover', backgroundPosition: 'center' }">
        <h1 class="text-white text-3xl sm:text-4xl font-bold text-center">Evtopia News and Insights</h1>
    </div>
    <div class="main-container py-14">
        <!-- Say Search Results if there is search key on url parameters -->
        <div class="w-full bg-white rounded-lg border border-slate-100 p-1 md:p-2 xl:p-3">
            <div class="relative overflow-hidden grow">
                <input type="text" v-model="search" :placeholder="$t('Search Blog')"
                    class="px-2 py-3 block rounded-lg border border-slate-200 focus:border-primary 
                    w-full placeholder:text-gray-400 outline-none text-base font-normal leading-normal"
                    @input="searchBlogs" >
                <button
                    class="bg-primary-600 h-full w-14 border-none absolute right-0 top-0 rounded-r-lg flex items-center justify-center"
                    @click="searchBlogs">
                    <MagnifyingGlassIcon class="w-6 h-6 text-white" />
                </button>
            </div>
        </div>
        <div v-if="hasFilterParams" class="flex mt-1 justify-between items-center w-full gap-4 flex-wrap">
            <div >
                {{ $t('Search Results') }}
                <span v-if="route.query.search">
                  {{ $t('for') }} "{{ route.query.search }}"
                </span>
                <span v-if="route.query.category_id">
                  {{ $t('for category with id') }} "{{ route.query.category_id }}"
                </span>
                <span v-if="route.query.tag_id">
                  {{ $t('with tag id') }} "{{ route.query.tag_id }}"
                </span>
            </div>
    
              <div >
                <button class=" text-red-500 rounded-lg py-2 px-4 hover:text-red-700  transition duration-300"
                  @click="resetSearch">{{ $t('Reset Search') }}</button>
              </div>

        </div>

          
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 items-start">
            
            <div v-for="post in posts" :key="post.id" class="w-full">
                <BlogCard :post="post" />
            </div>

        </div>

        <div class="flex justify-between items-center w-full mt-8  gap-4 flex-wrap">
            <div class="text-slate-800 text-base font-normal leading-normal">
                {{ $t('Showing') }} {{ perPage * (currentPage - 1) + 1 }} {{ $t('to') }} {{ perPage * (currentPage - 1) + shops.length }} {{ $t('of') }} {{
                totalPosts }} {{ $t('results') }}
            </div>
            <div>
                <vue-awesome-paginate :total-items="totalPosts" :items-per-page="perPage" type="button" :hide-prev-next-when-ends="true" :max-pages-shown="5" v-model="currentPage" @click="onClickHandler" />
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, onMounted,computed  ,watch} from 'vue';
import BlogCard from '../components/BlogCard.vue';
import { useMaster } from '../stores/MasterStore';
import { useRoute, useRouter } from 'vue-router';
import { MagnifyingGlassIcon, EyeSlashIcon, EyeIcon } from '@heroicons/vue/24/solid'

import banner from '../assets/blog-banner.jpg';
const masterStore = useMaster();
const router = new useRouter();
const currentPage = ref(1);
const perPage = ref(12);
const totalShops = ref(0);
const totalPosts = ref(0);

const shops = ref([]);
const posts = ref([]);

const route = useRoute();
const formData = ref({  });
const search = ref('');

onMounted(() => {
    formData.value = { ...route.query };
    if (!masterStore.multiVendor) {
        router.push('/');
        return;
    }
    fetchBlogs();

    window.scrollTo(0, 0);
});

const onClickHandler = async (page) => {
    currentPage.value = page;
    fetchBlogs();
};


const searchBlogs = () => {
   formData.value.search = search.value.trim(); // Add search term to formData if it's not empty

    if (formData.value.search) {
    router.push({ query: { ...route.query, search: formData.value.search } });
    } else {
    const { search, ...rest } = route.query;
    router.push({ query: rest });
    }
    fetchBlogs(); 
};

const fetchBlogs = async () => {
    axios.get('/blogs', { params: { page: currentPage.value, per_page: perPage.value , filter: formData.value} }).then((response) => {
        totalPosts.value = response.data.data.total;
        posts.value = response.data.data.posts;
    })
};

const hasFilterParams = computed(() => {
  return Object.keys(route.query).some(key => route.query[key]);
});

const resetSearch = () => {
    formData.value = {}; 
    router.push({ query: {} }); 

    fetchBlogs(); 
};

const hasSearchResults = computed(() => {
    return !!route.query.search;
});
</script>
