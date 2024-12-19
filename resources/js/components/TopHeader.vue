<template>
    <div class="bg-primary">
        <div class="main-container flex justify-between items-center py-2 px-[10px] md:px[1rem] text-white">

            <div class="flex sm:items-center flex-col sm:flex-row gap-1 sm:gap-4">
                <a v-if="master.getMultiVendor" href="/become_a_seller" class="text-white text-sm font-[300] font-['Roboto'] leading-tight">
                    {{ $t('Become a Seller') }}
                </a>
                <span> | </span>
                <!-- <div v-if="master.getMultiVendor" class="w-[0] h-3 border border-primary-500 hidden sm:block"></div> -->
                <a :href="'tel:' + master.mobile"  class="text-white text-sm font-[300] font-['Roboto'] leading-tight">
                    {{ master.mobile }}
                </a>
            </div>

            <Menu as="div" class="relative inline-block text-left">
                <div class="hidden md:inline-flex justify-start items-center gap-2.5  xlg:gap-4 grow">
                   
                 
        
                    <div class="w-[0px] h-4 border border-slate-200"></div>
        
                    
                    <router-link to="/about-us"
                        class="py-2 border-b-2 border-transparent text-sm font-[300] ">
                        {{ $t('About Us') }}
                    </router-link>
        
                    <div class="w-[0px] h-4 border border-slate-200"></div>
        
                    
                    <router-link to="/blog"
                        class="py-2 border-b-2 border-transparent text-sm font-[300] ">
                        {{ $t('Blog') }}
                    </router-link>
        
                    <div class="w-[0px] h-4 border border-slate-200"></div>
        
                    <router-link to="/contact-us"
                        class="h-10 py-2 border-b-2 border-transparent text-sm font-[300] ">
                        {{ $t('Contact') }}
                    </router-link>
        
        
        
                </div>
            </Menu>
        </div>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import  localization from '../localization';

import { useMaster } from "../stores/MasterStore";
import { onMounted, ref, watch } from 'vue';
const master = useMaster();

const currentLanguage = ref('English');

onMounted(() => {
    setCurrentLanguage(master.locale);
});

watch(() => master.locale, () => {
    setCurrentLanguage(master.locale);
});

const setCurrentLanguage = (lang) => {
    localization.fetchLocalizationData();
    master.locale = lang;
    localStorage.setItem('locale', lang);
  const language = master.languages.find(lang => lang.name === master.locale);
  
  if (language) {
    currentLanguage.value = language.title;
  }
};

</script>
