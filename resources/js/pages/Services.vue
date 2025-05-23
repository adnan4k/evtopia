<template>
    <div class="main-container pt-8 pb-12">

        <div class="text-slate-800 text-lg lg:text-3xl font-bold">{{ $t('Our Services') }}</div>

         <!-- shimmer  -->
            <div v-if="loading" class="mt-8 grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6 items-start">
                <div v-for="i in perPage" :key="`skeleton-${i}`" class="animate-pulse">
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <div class="h-60 bg-gray-200 rounded"></div>
                        <div class="mt-4 h-8 bg-gray-200 rounded"></div>
                        <div class="mt-2 h-8 bg-gray-200 rounded"></div>
                        <div class="mt-2 h-8 w-3/4 bg-gray-200 rounded"></div>
                    </div>
                </div>
            </div>
        <!-- services -->
         <div v-else class="mt-8">
             <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4  gap-3 sm:gap-6 items-start mt-6">
                 <div v-for="product in services" :key="product.id" class="w-full">
                     <ServiceCard :product="product" />
                 </div>
                 <div v-if="services.length == 0" class="text-slate-950 text-xl font-medium leading-7">
                     {{ $t('No Services Found') }}
                 </div>
             </div>
     
             <!-- Pagination -->
             <div class="flex justify-between items-center w-full mt-8  gap-4 flex-wrap">
                 <div class="text-slate-800 text-base font-normal leading-normal">
                     {{ $t('Showing') }} {{ (perPage * (currentPage - 1) + 1) }} to {{ (perPage * (currentPage - 1) + services.length) }}
                     {{ $t('of') }} {{ totalServices }} {{ $t('results') }}
                 </div>
                 <div>
                     <vue-awesome-paginate :total-items="totalServices" :items-per-page="perPage" type="button"
                         :max-pages-shown="5" v-model="currentPage" :hide-prev-next-when-ends="true" @click="onClickHandler" />
                 </div>
             </div>
         </div>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ProductCard from '../components/ProductCard.vue';
import ServiceCard from '../components/ServiceCard.vue';


const currentPage = ref(1);
const perPage = ref(12);

const services = ref([]);
const totalServices = ref(0);
const loading = ref(true);

onMounted(() => {
    fetchServices();
    window.scrollTo(0, 0);
});

const onClickHandler = async (page) => {
    currentPage.value = page;
    fetchServices();
};

const fetchServices = async () => {
    axios.get('/services', { params: { page: currentPage.value, per_page: perPage.value } }).then((response) => {
        totalServices.value = response.data.data.total;
        services.value = response.data.data.services;

    }).catch((error) => {
        console.error('Error fetching services:', error);
    }).finally(() => {
        loading.value = false;
    });
};

</script>
