<template>
    <div class="rounded-lg border transition-all duration-300 group bg-white overflow-hidden relative"
        >

        <div class="flex flex-col">
            <div class="bg-white">
                <div class="w-full h-36 sm:h-52 overflow-hidden relative"
                    :class="opacity-30">
                    <div class="cursor-pointer" @click="showServiceDetails">
                        <!-- thumbnail -->
                        <img :src="props.product?.thumbnail" loading="lazy"
                            class="w-full h-full group-hover:scale-110 transition duration-500 object-cover" />
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
                <div class="cursor-pointer" @click="showServiceDetails">
                    <div class="bg-white p-2 flex flex-col items-start gap-2 col-span-2">

                        <div class="text-slate-950 text-base font-bold leading-normal truncate w-full"
                            :class="opacity-30">

                           {{  truncateServiceTitle(props.product?.name)  }}


                                <div
                                    v-for="(category, index) in props.product.categories || ['Uncategorized']"
                                    :key="index"
                                    class=" my-1"
                                    
                                >
                                <span class="text-primary  text-xs font-normal leading-none px-1.5 py-1 bg-primary-50 rounded">
                                    {{ category }}
                                </span>
                                </div>
                        </div>
                        

                        <div class="text-slate-460 text-base font-normal leading-normal  w-full"
                            :class="opacity-30">
                           {{  truncateDescription(props.product?.short_description)  }}
                        </div>
                        
                        <!-- <div class="flex  w-full"> -->

                            <button class="mt-2 w-full px-4 py-1 md:py-2 border border-primary rounded-lg text-primary hover:bg-primary hover:text-white transition duration-300 text-base font-medium">
                                Contact Us
                            </button>

                            <!-- <button class="mt-2 px-4 py-1 md:py-2 bg-primary rounded-lg text-white text-base font-medium">
                                Detail 
                            </button> -->

                        <!-- </div> -->
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</template>

<script setup>
import { useToast } from 'vue-toastification';
import { useBaskerStore } from '../stores/BasketStore';
import { useServiceStore } from '../stores/ServiceStore';
import { useMaster } from '../stores/MasterStore';
import { StarIcon, HeartIcon } from '@heroicons/vue/24/solid';
import { HeartIcon as HeartIconOutline } from '@heroicons/vue/24/outline';
import { useAuth } from '../stores/AuthStore';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const masterStore = useMaster();

const baskerStore = useBaskerStore();
const serviceStore = useServiceStore();
const authStore = useAuth();

const toast = useToast();

const props = defineProps({
    product: Object
});

const orderData = {
    service_id: props.product?.id,
    quantity: 1,
};

const addToBasket = (product) => {
    // add product to basket
    serviceStore.addToCart(orderData, product);
};

const buyNow = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    baskerStore.buyNowProduct = props.product;
    router.push({ name: 'buynow' })
};

const truncateDescription = (description) => {
    if (description.length > 120) {
        return description.substring(0, 120) + '...';
    }
    return description;
}

const truncateServiceTitle = (title) => {
    if (title.length > 45) {
        return title.substring(0, 45) + '...';
    }
    return title;
}
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

const showServiceDetails = () => {
        router.push({ name: 'serviceDetails', params: { id: props.product.id } })
}

</script>
