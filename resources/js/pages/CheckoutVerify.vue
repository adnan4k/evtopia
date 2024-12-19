<template>
    <div class="main-container">

        <!-- Breakcrumbs -->
        <div class="flex items-center gap-2 overflow-hidden pt-4">
            <router-link to="/" class="w-6 h-6">
                <HomeIcon class="w-5 h-5 text-slate-600" />
            </router-link>

            <div class="grow w-full overflow-hidden">
                <div class="space-x-1 text-slate-600 text-sm font-normal truncate">
                    <span>{{ $t('Home') }} </span>
                    <span>/</span>
                    <span>{{ $t('Cart') }}</span>
                    <span>/</span>
                    <span>{{ $t('Verify Payment') }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 my-3 gap-8">

            <div class="col-span-1 xl:col-span-2">

                <div class="py-4 border-b tran" :class="showProductItems ? 'border-primary' : 'border-slate-200'">
                    <!-- checkout -->
                    <div class="flex gap-2 justify-between items-center">
                        <div class="text-slate-950 text-lg sm:text-3xl font-medium leading-10">{{ $t('Verifying Payment ... ') }}</div>
                        <div class="flex items-center gap-2 cursor-pointer"
                            @click="showProductItems = !showProductItems">
                            <div class="text-primary-600 text-lg font-medium leading-normal tracking-tight">
                                ({{ basketStore.checkoutTotalItems  + serviceStore.total }} {{ $t('items') }})
                            </div>
                            <ChevronDownIcon class="w-5 h-5 text-primary-600 transition duration-300"
                                :class="showProductItems ? 'rotate-180' : ''" />
                        </div>
                    </div>

                    <!-- Product items -->
                    <div v-if=" basketStore.checkoutTotalItems > 0 && showProductItems">
                        <h1 class="text-slate-950  font-bold leading-7 flex justify-center">{{ $t('Product Cart Items') }}</h1>

                        <checkoutProducts />
                    </div>

                    <div v-if="serviceStore.total > 0 && showProductItems">
                        <h1 class="text-slate-950 pt-3  font-bold leading-7 flex justify-center">{{ $t('Services Cart Items') }}</h1>
                        <checkoutServices />
                    </div>
                </div>

                <!-- Shipping Address -->
                <ShippingAddress />

                <div class="mt-6">
                    <div class="mb-1">
                        <span class="text-slate-950 text-xl font-medium leading-7">{{ $t('Note') }}</span>
                        <span class="text-slate-500 text-lg font-normal leading-7 tracking-tight">
                            ({{ $t('Optional') }})
                        </span>
                    </div>
                    <textarea v-model="note" rows="3" class="form-input"
                        :placeholder="$t('Write your note') + '...'"></textarea>
                </div>

                <!-- Payment Method -->
              

            </div>

            <!-- Order Summary -->
            <CheckoutOrderSummary :note="note" :paymentMethod="paymentMethod" />

        </div>

    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import { HomeIcon, ChevronDownIcon } from '@heroicons/vue/24/outline';

import checkoutProducts from '../components/checkoutProducts.vue';
import checkoutServices from '../components/checkoutServices.vue';
import CheckoutOrderSummary from '../components/CheckoutOrderSummary.vue';
import ShippingAddress from '../components/CheckoutShippingAddress.vue';

import { useAuth } from '../stores/AuthStore';
const AuthStore = useAuth();

import { useMaster } from '../stores/MasterStore';
import { useBaskerStore } from '../stores/BasketStore';
import { useServiceStore } from '../stores/ServiceStore';

import { useRouter,useRoute } from 'vue-router';
const router = new useRouter();
const route = useRoute();

const master = useMaster();
const basketStore = useBaskerStore();
const serviceStore = useServiceStore();

const showProductItems = ref(false);

const note = ref("");

const paymentType = ref('cash');
const paymentMethod = ref(null);

const paymentGateway = ref(null);
// Access the parameters correctly
console.log("ID", route.params.id); // Accesses the route parameter `id`
console.log("Payment ID", route.query.payment_id); // Accesses the query parameter `payment_id`
onMounted(() => {

    verifyPayment();
    window.scrollTo(0, 0);
    basketStore.coupon_code = "";
    paymentMethod.value = paymentType.value;
    if (!AuthStore.user) {
        router.push({ name: 'home' });
    }
    AuthStore.showAddressModal = false;
    AuthStore.showChangeAddressModal = false;
});


const verifyPayment = async () => {
    axios.get('/verify_payment' , {
        params: { reference: route.params.id, payment_id: route.query.payment_id },
        headers: {
            Authorization: AuthStore.token,
        }
    }).then((response) => {
        if(response.status === 200){
            console.log(response);
            basketStore.showOrderConfirmModal = true

        }
    });
};

watch(paymentType, () => {
    if (paymentType.value === 'card') {
        paymentMethod.value = paymentGateway.value;
    } else {
        paymentMethod.value = paymentType.value;
    }
});

watch(paymentGateway, () => {
    if (paymentType.value === 'card') {
        paymentMethod.value = paymentGateway.value;
    }
});

</script>
<style scoped>
.form-label {
    @apply text-slate-700 text-base font-normal leading-normal;
}

.form-input {
    @apply p-3 rounded-lg border border-slate-200 focus:border-primary w-full outline-none text-base font-normal leading-normal placeholder:text-slate-400;
}

.formInputCoupon {
    @apply rounded-lg border border-slate-200 focus:border-primary w-full outline-none text-base font-normal leading-normal placeholder:text-slate-400;
}

.radio-btn {
    @apply w-5 h-5 border appearance-none border-slate-300 rounded-full checked:bg-primary ring-primary checked:outline-1 outline-offset-1 checked:outline-primary checked:outline transition duration-100 ease-in-out m-0;
}

.radioBtn2 {
    @apply w-4 h-4 border appearance-none border-slate-300 rounded-full checked:bg-primary ring-primary checked:outline-1 outline-offset-1 checked:outline-primary checked:outline transition duration-100 ease-in-out m-0;
}
</style>
