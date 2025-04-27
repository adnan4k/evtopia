<template>
    <div class="main-container pt-8 pb-6 sm:pt-14 sm:pb-10 bg-primary-700 text-white">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!--===== ReadyeCommerce (col-1) =====-->
            <div>
                <div>
                    <img :src="masterData.web_footer_logo" class="h-16 bg-slate-900 rounded-md" loading="lazy" />
                </div>
                <div class="mt-6 max-w-[328px]">
                    <div class="text-white text-sm font-normal leading-normal">
                        {{ masterData.web_footer_description }}
                    </div>

                    <div class="mt-4 p-4 bg-black bg-opacity-20 rounded-[56px] flex gap-3">
                        <DevicePhoneMobileIcon class="w-6 h-6 text-white" />
                        <div class="w-[0px] h-6 border border-primary-900"></div>
                        <a :href="'tel:' + masterData.mobile"  class="text-white text-base font-normal leading-normal">
                            {{ masterData.mobile }}
                        </a>
                    </div>
                    
                    <div class="mt-3 p-4 bg-black bg-opacity-20 rounded-[56px] flex gap-3">
                        <EnvelopeIcon class="w-6 h-6 text-white" />
                        <div class="w-[0px] h-6 border border-primary-900"></div>
                        <a :href="'mailto:' + masterData.email"  class="text-white text-base font-normal leading-normal">
                            {{ masterData.email }}
                        </a>
                    </div>
                </div>

                <div class="flex justify-start mt-5 items-center gap-6">
                    <div class="flex items-center gap-3">
                        <a v-for="socialLink in masterData.social_links" :key="socialLink.name" target="_blank" :href="socialLink.link" class="w-8 h-8 bg-primary-800 rounded-full overflow-hidden">
                            <img :src="socialLink.logo" alt="" class="w-full h-full object-cover">
                        </a>
                    </div>
                </div>
            </div>

            <!--===== Quick Links (col-2) =====-->
            <div class="mt-4 sm:mt-0">
                <div class="text-white text-lg font-medium leading-normal tracking-tight">{{ $t('Quick Links') }}</div>

                <div class="flex flex-col gap-2 mt-6">
                    <router-link v-if="master.getMultiVendor" to="/all_products"
                        class="py-2 hover:text-slate-300-500 text-white text-base font-normal leading-normal">
                        {{ $t('Buy Now') }}
                    </router-link>
                    <a href="/shop/register"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('Add Your Shop') }}
                    </a>
                    <a href="/shop/individual"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('Sell Your EV') }}
                    </a>
                    <router-link v-if="master.getMultiVendor" to="/shops"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('All Shops') }}
                    </router-link>

                    <router-link v-if="!master.getMultiVendor" to="/contact-us"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('Contact') }}
                    </router-link>

                    <a target="_blank" href="#"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('Join Our Forum') }}
                    </a>
                </div>
            </div>

            <!--===== Company (col-3) =====-->
            <div class="mt-4 lg:mt-0">
                <div class="text-white text-lg font-medium leading-normal tracking-tight">{{ $t('Company') }}</div>

                <div class="flex flex-col gap-2 mt-6">
                    <router-link to="/about-us"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('About us') }}
                    </router-link>
                    <router-link v-if="master.getMultiVendor" to="/contact-us"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('Contact') }}
                    </router-link>
                    <router-link to="/terms-and-conditions"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('Terms & Conditions') }}
                    </router-link>
                    <router-link to="/privacy-policy"
                        class="py-2 hover:text-slate-300 text-white text-base font-normal leading-normal">
                        {{ $t('Privacy Policy') }}
                    </router-link>
                </div>
            </div>

            <!--===== Download our app (col-4) =====-->
            <div  class="mt-4 lg:mt-0">
                <div class="text-white text-lg font-medium leading-normal tracking-tight">
                    {{ $t('Download our app') }}
                </div>

                <div class="mt-6">
                    <div v-if="masterData.footer_qr" class="bg-white rounded-md w-28 overflow-hidden">
                        <img :src="masterData.footer_qr" class="h-28 w-full" loading="lazy" />
                        <div class="text-center text-primary-950 text-sm font-normal leading-tight pb-1">
                            {{ $t('Scan the QR') }}
                        </div>
                    </div>

                    <div class="flex justify-start gap-4 mt-6">
                        <button class="border-none w-[119.70px] h-10 py-1 px-2 bg-primary-900 rounded-lg" @click="appStore">
                            <img :src="'/assets/icons/appstoreFooter.svg'" alt="appstore" class="w-full h-full object-fill" loading="lazy" />
                        </button>
                        <button class="border-none w-[119.70px] h-10 py-1 px-2 bg-primary-900 rounded-lg" @click="playStore">
                            <img :src="'/assets/icons/playstoreFooter.svg'" alt="playstore" class="w-full h-full object-fill" loading="lazy" />
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import { DevicePhoneMobileIcon, EnvelopeIcon } from '@heroicons/vue/24/outline';

import { useMaster } from "../stores/MasterStore";
const master = useMaster();

const { masterData } = defineProps(['masterData']);

const appStore = () => {
    if (masterData.app_store_link) {
        window.open(masterData.app_store_link, '_blank');
    }

}



const playStore = () => {
    console.log("Master",masterData);

    if (masterData.google_playstore_link) {
        window.open(masterData.google_playstore_link, '_blank');
    }
}

</script>
