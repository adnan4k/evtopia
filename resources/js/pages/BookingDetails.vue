<template>
    <div>
        <div class="bg-white px-3 text-slate-600 flex items-center gap-1 pt-2">
            <HomeIcon class="w-5 h-5 md:w-6 md:h-6" />
            <router-link to="/order-history" class="leading-normal hover:text-primary">
                {{ $t('Booking History') }}
            </router-link>
            <span class="leading-normal">/ {{ $t('Booking Details') }}</span>
        </div>

        <!-- Header -->
        <AuthPageheader :title="$t('Booking  Details')" />

        <!-- Order details -->
        <div class="px-2 pt-2 md:px-4 md:pt-4 lg:px-6 lg:pt-6">
            <BookingDetailsBookingStatus :order="order" />

            <div class="grid grid-cols-3 gap-4 md:gap-6 mt-4 p-3 md:p-4 xl:p-6 bg-white rounded-lg md:rounded-2xl">
                <!-- column 1 -->
                <div
                    class="col-span-3 lg:col-span-2 bg-white rounded-lg md:rounded-2xl border border-slate-100 p-3 md:p-4 xl:p-6">
                    <div class="w-full h-[0px] border-t border-slate-200 my-3"></div>

                    <div class="text-slate-600 text-sm md:text-base font-normal leading-tight">
                        {{ $t('Services') }} ({{ order.products?.length }})
                    </div>

                    <BookingServices :order="order" @refresh="fetchOrderDetails"/>
                </div>

                <!-- column 2 -->
                <div class="col-span-3 lg:col-span-1">

                    <BookingDetailsSummery :order="order" @update:paymentSuccess="fetchOrderDetails"/>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { HomeIcon } from "@heroicons/vue/24/outline";
import { StarIcon } from "@heroicons/vue/24/solid";
import AuthPageheader from "../components/AuthPageheader.vue";
import BookingDetailsBookingStatus from "../components/BookingDetailsBookingStatus.vue";
import OrderProducts from "../components/OrderProducts.vue";
import BookingServices from "../components/BookingServices.vue";
import OrderDetailsSummery from "../components/OrderDetailsSummery.vue";
import BookingDetailsSummery from "../components/BookingDetailsSummery.vue";
import { useRoute } from 'vue-router';

import { useAuth } from "../stores/AuthStore";
const authStore = useAuth();
const route = useRoute();

const order = ref({});

watch(() => authStore.orderCancel, () => {
    if (authStore.orderCancel == true) {
        fetchOrderDetails();
    }
    authStore.orderCancel = false;
});

onMounted(() => {
    fetchOrderDetails();
    window.scrollTo(0, 0, { behavior: 'smooth' });
});

const fetchOrderDetails = async () => {
    axios.get('/booking-details', {
        params: { booking_id: route.params.id },
        headers: {
            Authorization: authStore.token,
        }
    }).then((response) => {
        order.value = response.data.data.order;
        console.log(order.value)
    });
};


</script>
