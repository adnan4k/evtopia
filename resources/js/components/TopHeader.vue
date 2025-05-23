<template>
    <div class="bg-primary">
        <div class="main-container flex justify-between items-center py-2 px-[10px] md:px[1rem] text-white">

            <div class="hidden  items-center md:flex sm:items-center flex-col sm:flex-row gap-1 sm:gap-4">
                <a v-if="master.getMultiVendor" href="/become_a_seller" class="text-white text-sm font-[300] font-['Roboto'] leading-tight">
                    {{ $t('Become a Seller') }}
                </a>
                <!-- <div v-if="master.getMultiVendor" class="w-[0] h-3 border border-primary-500 hidden sm:block"></div> -->
                <a :href="'tel:' + master.mobile"  class="text-white text-sm font-[300] font-['Roboto'] leading-tight">
                    |   {{ master.mobile }}
                </a>
            </div>


             <div class="flex  items-center md:hidden " >
                <Popover v-slot="{ open }">
                    <div class="">
                        <PopoverButton class="h-10 lg:h-12 flex px-2 items-center gap-[2px] outline-none rounded-lg transition-all"
                            :class="open ? 'bg-primary-700 text-slate-900' : 'text-slate-100'">
                            <div class="w-12 md:w-auto lg:w-12 flex items-center justify-center">
                                <img :src="open ? '/assets/icons/menuActive.svg' : '/assets/icons/whiteMenuActive.svg'" alt=""
                                    class="w-6 h-6" />
                            </div>
                            <div
                                class="block lg:w-28 xl:w-36 text-left lg:text-sm font-[400]  text-white leading-normal">
                                {{ $t('Brands') }}</div>
                        </PopoverButton>
                    </div>

                    <transition enter-active-class="transition ease-out duration-200"
                    enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 translate-y-1">

                    <PopoverPanel style="z-index:100 !important;" class="absolute pb-6 left-0 right-0 z-10 mt-2 flex main-container">
                        <PopoverButton as="div" class="w-screen p-6 bg-white shadow-md grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 xl:grid-cols-10 gap-4 rounded-br-xl rounded-bl-xl">
                            <div v-for="category in master.categories" :key="category.id" class="">
                                <MenuCategory :category="category" @update:click="hiddenPopover" />
                            </div>
                        </PopoverButton>
                    </PopoverPanel>
                </transition>
                </Popover>

            </div>
            

            <Menu as="div" class="relative inline-block text-left">
                <div class="hidden md:inline-flex justify-start items-center gap-2.5  xlg:gap-4 grow">
                   
                 
                    <div class="w-[0px] h-4 border border-slate-200"></div>

                    <router-link to="/knowledge-center"
                        class="py-2 border-b-2 border-transparent text-sm font-[300] ">
                        {{ $t('Knowledge Hub') }}
                    </router-link>                    
        
        
                    <div class="w-[0px] h-4 border border-slate-200"></div>
        
                    
                    <router-link to="/blog"
                        class="py-2 border-b-2 border-transparent text-sm font-[300] ">
                        {{ $t('Blog') }}
                    </router-link>
                    
                    <div class="w-[0px] h-4 border border-slate-200"></div>
        
                    
                    <router-link to="/about-us"
                        class="py-2 border-b-2 border-transparent text-sm font-[300] ">
                        {{ $t('About Us') }}
                    </router-link>
        
                   

                   
                    <div class="w-[0px] h-4 border border-slate-200"></div>
        
                    <router-link to="/contact-us"
                        class="h-10 py-2 border-b-2 border-transparent text-sm font-[300] ">
                        {{ $t('Contact') }}
                    </router-link>
        
                    <Menu as="a" 
                        style="
                            background: black;
                            padding: 4px 8px;
                            border-radius: 5px;
                            
                        "
                    >
                        <div>
                            <MenuButton
                                class="inline-flex items-center text-white font-['Roboto'] gap-1 text-sm font-normal leading-tight">
                                <LanguageIcon class="w-4 h-4" aria-hidden="true" />

                                {{ currentLanguage }}
                                <ChevronDownIcon class="w-4 h-4" aria-hidden="true" />
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="absolute z-20 w-24 mt-1 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" :class="master.langDirection == 'rtl' ? 'left-0' : 'right-0'">
                                <div class="py-1">
                                    <MenuItem v-for="language in master.languages" v-slot="{ active }" :key="language.id">
                                    <button type="button" @click="setCurrentLanguage(language.name); reloadPage()"
                                        class="w-full flex gap-1 text-left" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                <!-- <LanguageIcon class="w-4 h-4" aria-hidden="true" /> -->
                                        
                                        {{
                                            language.title }}</button>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
        
                </div>

                 <div class="flex items-center gap-5 md:hidden">
                    <button :class="active ? ' text-gray-900' : 'text-gray-700'" @click="playStore">
                        
                        <img class="w-7"  :src="'/assets/icons/transparent_gplay.png'" alt="">
                    </button>

                    <button :class="active ? ' text-gray-900' : 'text-gray-700'" @click="appStore">
                        
                        <img class="w-6" :src="'/assets/icons/astore.png'" alt="">
                    </button>

                        <Menu as="a" 
                        style="
                            background: black;
                            padding: 4px 5px 4px 3px;
                            border-radius: 5px;
                            
                        "
                    >
                        <div>
                            <MenuButton
                                class="inline-flex items-center text-white font-['Roboto'] gap-1 text-sm font-normal leading-tight">
                                <LanguageIcon class="w-6 h-4" aria-hidden="true" />

                                <!-- {{ currentLanguage }} -->
                                <!-- <ChevronDownIcon class="w-4 h-4" aria-hidden="true" /> -->
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="absolute z-20 w-24 mt-1 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" :class="master.langDirection == 'rtl' ? 'left-0' : 'right-0'">
                                <div class="py-1">
                                    <MenuItem v-for="language in master.languages" v-slot="{ active }" :key="language.id">
                                    <button type="button" @click="setCurrentLanguage(language.name); reloadPage()"
                                        class="w-full flex gap-1 text-left" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">
                                <!-- <LanguageIcon class="w-4 h-4" aria-hidden="true" /> -->
                                        
                                        {{
                                            language.title }}</button>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </Menu>

             
        </div>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon, LanguageIcon } from '@heroicons/vue/20/solid'
import  localization from '../localization';
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
import { DevicePhoneMobileIcon } from '@heroicons/vue/24/outline'
import MenuCategory from './MenuCategory.vue';
import { useMaster } from "../stores/MasterStore";
import { onMounted, ref, watch } from 'vue';
const master = useMaster();

const currentLanguage = ref('Eng');




const appStore = () => {
    if (master.appStoreLink) {
        window.open(master.appStoreLink, '_blank');
    }
}

const playStore = () => {
    if (master.playStoreLink) {
        window.open(master.playStoreLink, '_blank');
    }
}

const hiddenPopover = () => {
   open = false
}
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
