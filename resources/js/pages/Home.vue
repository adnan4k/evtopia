<template>
    <div>
        <HeroBanner :banners="banner" :ads="ads"  :loading="loading" />
        <CategoriesOverview />
        <SpecialOffer :products="specialOffers"  :loading="loading"/>
        <AboutSection />

        <Categories :categories="categories" :loading="loading"/>

        <PopularProducts :products="popularProducts"  :loading="loading"/>
        <!-- <WhyElectricVehicle /> -->
        <!-- <Categories :categories="categories" /> -->
        <!-- <FlashSale /> -->

          <div class="py-8">
             <AboutEvtopia/>
         </div>

        <PopularServices :products="popularServices"  :loading = "loading"/>

        <div v-if="master.getMultiVendor">
            <TopRatedShops :shops="topRatedShops" :loading="loading"/>
        </div>
         <!-- <StatisticsSection/> -->
        <LatestProducts :justForYou="justForYou" :loading="loading"/>
        <!-- <RecentlyViews :products="recentlyViewProducts" /> -->
         <hr>
       
         <div class="py-8">
            <KnowledgeHubSection :knowledge_hubs="knowledge_hubs" :loading="loading"/>
        </div>

        <BlogSection :posts="posts"  :loading="loading"/>
    </div>
</template>

<script setup>
import { useMaster } from "../stores/MasterStore";
import { useBaskerStore } from "../stores/BasketStore";
import { useServiceStore } from "../stores/ServiceStore";
import { onMounted, ref } from "vue";
import HeroBanner from "../components/HeroBanner.vue";
import AboutSupport from "../components/AboutSupport.vue";
import AboutEvtopia from "../components/AboutEvtopia.vue";
import KnowledgeHubSection from "../components/KnowledgeHubSection.vue";
import WhyElectricVehicle from "../components/WhyElectricVehicle.vue";
import Categories from "../components/Categories.vue";
import FlashSale from "../components/FlashSale.vue";
import SpecialOffer from "../components/SpecialOffer.vue";
import PopularProducts from "../components/PopularProducts.vue";
import PopularServices from "../components/PopularServices.vue";
import TopRatedShops from "../components/TopRatedShops.vue";
import LatestProducts from "../components/LatestProducts.vue";
import RecentlyViews from "../components/RecentlyViews.vue";
import BlogSection from "../components/BlogSection.vue";

import { useAuth } from "../stores/AuthStore";
import axios from "axios";
import AboutSection from "../components/AboutSection.vue";
import CategoriesOverview from "../components/CategoriesOverview.vue";
import StatisticsSection from "../components/StatisticsSection.vue";

const master = useMaster();
const baskerStore = useBaskerStore();
const serviceStore = useServiceStore();

const authStore = useAuth();
const loading = ref(true);


onMounted(() => {
    getData();
    master.fetchData();
    baskerStore.fetchCart();
    serviceStore.fetchCart();
    fetchViewProducts();
    // fetchBlogs();
    // fetchKnowledgeHubs();
    master.basketCanvas = false;
    authStore.loginModal = false;
    authStore.registerModal = false;
    authStore.showAddressModal = false;
    authStore.showChangeAddressModal = false;
});

const banner = ref([]);
const categories = ref([]);
const flashSale = ref([]);
const popularProducts = ref([]);
const specialOffers = ref([]);
const popularServices = ref([]);
const topRatedShops = ref([]);
const justForYou = ref([]);
const recentlyViewProducts = ref([]);
const posts = ref([]);
const ads = ref([]);
const knowledge_hubs = ref([]);

const getData = () => {
    loading.value = true;

    axios.get('/home?page=1&per_page=12', {
        headers: {
            Authorization: authStore.token
        }
    }).then((response) => {
        ads.value = response.data.data.ads;
        banner.value = response.data.data.banners;
        categories.value = response.data.data.categories;
        justForYou.value = response.data.data.just_for_you;
        popularProducts.value = response.data.data.popular_products;
        popularServices.value = response.data.data.popular_services;
        specialOffers.value = response.data.data.special_offers;
        topRatedShops.value = response.data.data.shops.slice(0, 4);
        posts.value = response.data.data.posts.slice(0, 5);
        knowledge_hubs.value = response.data.data.knowledge_hubs.slice(0, 5);

        console.log('Service : ',popularServices.value);
    }).catch(() => {})
    .finally(() => {
      loading.value = false;
    });

    // fetch categories
    axios.get('/categories').then((response) => {
        master.categories = response.data.data.categories;
    }).catch(() => {})
    .finally(() => {
      loading.value = false;
    });
}

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


const fetchBlogs = () => {
    if (authStore.token) {
        axios.get('/featured_blogs',{ params: { per_page: 5} }, {
            headers: {
                Authorization: authStore.token
            }
        }).then((response) => {
            posts.value = response.data.data.posts;

            console.log('Blogs : ',blogs.value);
        }).catch(() => {});
    }
}

const fetchKnowledgeHubs = () => {
    if (authStore.token) {
        axios.get('/knowledge_hubs',{ params: { per_page: 5 } }, {
            headers: {
                Authorization: authStore.token
            }
        }).then((response) => {
            knowledge_hubs.value = response.data.data.posts;
            console.log('Knowledge Hubs : ',knowledge_hubs.value);

        }).catch(() => {});
    }
}

</script>

<style scoped></style>
