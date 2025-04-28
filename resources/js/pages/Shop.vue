<template>
    <div class="main-container py-14">
  
      <!-- Title -->
      <div class="text-slate-800 text-3xl font-bold leading-9">
        {{ $t('All Shops') }}
      </div>
  
      <!-- 1) SHIMMER SKELETON GRID -->
      <div
        v-if="loading"
        class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"
      >
        <div
          v-for="i in perPage"
          :key="`skeleton-${i}`"
          class="animate-pulse"
        >
          <div class="bg-white shadow rounded-lg p-4">
            <div class="h-40 bg-gray-200 rounded mb-4"></div>
            <div class="h-6 bg-gray-200 rounded w-3/4 mb-2"></div>
            <div class="h-4 bg-gray-200 rounded w-1/2"></div>
          </div>
        </div>
      </div>
  
      <!-- 2) REAL SHOPS GRID -->
      <div
        v-else
        class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 items-start"
      >
        <div v-for="shop in shops" :key="shop.id" class="w-full">
          <ShopCard :shop="shop" />
        </div>
      </div>
  
      <!-- Pagination (only when loaded) -->
      <div
        v-if="!loading"
        class="flex justify-between items-center w-full mt-8 gap-4 flex-wrap"
      >
        <div class="text-slate-800 text-base font-normal leading-normal">
          {{ $t('Showing') }} {{ from }} {{ $t('to') }} {{ to }} {{ $t('of') }} {{ totalShops }} {{ $t('results') }}
        </div>
        <div>
          <vue-awesome-paginate
            :total-items="totalShops"
            :items-per-page="perPage"
            type="button"
            :hide-prev-next-when-ends="true"
            :max-pages-shown="5"
            v-model="currentPage"
            @click="onClickHandler"
          />
        </div>
      </div>
  
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  import { useMaster } from '../stores/MasterStore';
  import ShopCard from '../components/ShopCard.vue';
  import { useAuth } from '../stores/AuthStore';
  import VueAwesomePaginate from 'vue-awesome-paginate';
  import 'vue-awesome-paginate/dist/style.css';
  
  const masterStore = useMaster();
  const authStore = useAuth();
  const router = useRouter();
  
  // Pagination state
  const currentPage = ref(1);
  const perPage = ref(12);
  const totalShops = ref(0);
  
  // Shops data and loading flag
  const shops = ref([]);
  const loading = ref(true);
  
  // Computed indices for display
  const from = computed(() => (currentPage.value - 1) * perPage.value + 1);
  const to = computed(() => (from.value - 1) + shops.value.length);
  
  onMounted(() => {
    if (!masterStore.multiVendor) {
      router.push('/');
      return;
    }
    fetchShops();
    window.scrollTo(0, 0);
  });
  
  function onClickHandler(page) {
    currentPage.value = page;
    fetchShops();
  }
  
  async function fetchShops() {
    loading.value = true;
    try {
      const { data } = await axios.get('/shops', {
        params: { page: currentPage.value, per_page: perPage.value }
      });
      totalShops.value = data.data.total;
      shops.value = data.data.shops;
    } catch (e) {
      console.error(e);
    } finally {
      loading.value = false;
    }
  }
  </script>
  
  <style scoped>
  /* no additional styles */
  </style>
   