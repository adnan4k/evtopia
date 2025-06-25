<template>
    <div class="md:py-8 px-8 mt-10 mb-10">

            
            <div class="grid grid-cols-2 md:grid-cols-3  gap-2 md:gap-4 ">

                <div class="w-full">
                    <router-link to="/all_products" class="w-full">
                        <div 
                            class="w-full bg-white rounded-lg 
                                   md:rounded-2xl border border-primary 
                                   px-2 py-3 group hover:bg-primary 
                                   transition-all duration-300 ease-in-out">
                            <div class="flex flex-col justify-center items-center gap-2">
                                <FontAwesomeIcon 
                                    :icon="faCartArrowDown" 
                                    class="text-primary text-[30px] group-hover:text-white 
                                           transition-colors duration-300 ease-in-out" />
                                <span 
                                    class="text-slate-800 text-xs md:text-[14px] font-bold leading-9 
                                           group-hover:text-white transition-colors duration-300 ease-in-out">
                                    {{ $t('Buy Now') }}
                                </span>
                            </div>
                        </div>
                    </router-link>
                </div>
                

                
                <div class="w-full">
                    <a href="/shop/individual" class="w-full">
                        <div 
                            class="w-full bg-white rounded-lg 
                                   hover:bg-primary md:rounded-2xl border border-primary 
                                   px-2 py-3 group transition-all duration-300 ease-in-out">
                            <div class="flex flex-col justify-center items-center gap-2">
                                <FontAwesomeIcon 
                                    :icon="faDollar" 
                                    class="text-primary text-[30px] group-hover:text-white transition-colors duration-300 ease-in-out" />
                                <span 
                                    class="text-slate-800 text-xs md:text-[14px] font-bold leading-9 group-hover:text-white transition-colors duration-300 ease-in-out">
                                    {{ $t('Sell Your EV') }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="w-full">
                    <a href="/shop/register" class="w-full">
                        <div 
                            class="w-full bg-white rounded-lg 
                                   hover:bg-primary md:rounded-2xl border border-primary 
                                   px-2 py-3 group transition-all duration-300 ease-in-out">
                            <div class="flex flex-col justify-center items-center gap-2">
                                <FontAwesomeIcon 
                                    :icon="faHomeAlt" 
                                    class="text-primary text-[30px] group-hover:text-white transition-colors duration-300 ease-in-out" />
                                <span 
                                    class="text-slate-800 text-xs md:text-[14px] font-bold leading-9 group-hover:text-white transition-colors duration-300 ease-in-out">
                                    {{ $t('Add Your Shop') }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="w-full">
                    <router-link to="/services" class="w-full">
                        <div 
                            class="w-full bg-white rounded-lg 
                                   hover:bg-primary md:rounded-2xl border border-primary 
                                   px-2 py-3 group transition-all duration-300 ease-in-out">
                            <div class="flex flex-col justify-center items-center gap-2">
                                <FontAwesomeIcon 
                                    :icon="faCog" 
                                    class="text-primary text-[30px] group-hover:text-white transition-colors duration-300 ease-in-out" />
                                <span 
                                    class="text-slate-800 text-xs md:text-[14px] font-bold leading-9 group-hover:text-white transition-colors duration-300 ease-in-out">
                                    {{ $t('Our Services') }}
                                </span>
                            </div>
                        </div>
                    </router-link>
                </div>
                
                <div class="w-full">
                    <router-link to="/how-ev-works" class="w-full">
                        <div 
                            class="w-full bg-white rounded-lg 
                                   hover:bg-primary md:rounded-2xl border border-primary 
                                   px-2 py-3 group transition-all duration-300 ease-in-out">
                            <div class="flex flex-col justify-center items-center gap-2">
                                <FontAwesomeIcon 
                                    :icon="faCar" 
                                    class="text-primary text-[30px] group-hover:text-white transition-colors duration-300 ease-in-out" />
                                <span 
                                    class="text-slate-800 text-xs md:text-[14px] font-bold leading-9 group-hover:text-white transition-colors duration-300 ease-in-out">
                                    {{ $t('How EV works?') }}
                                </span>
                            </div>
                        </div>
                    </router-link>
                </div>
                
                <div class="w-full">
                    <a href="https://lms.evtopia.co" target="_blank" class="w-full">
                        <div 
                            class="w-full bg-white rounded-lg 
                                   hover:bg-primary md:rounded-2xl border border-primary 
                                   px-2 py-3 group transition-all duration-300 ease-in-out">
                            <div class="flex flex-col justify-center items-center gap-2">
                                <FontAwesomeIcon 
                                    :icon="faBook" 
                                    class="text-primary text-[30px] group-hover:text-white transition-colors duration-300 ease-in-out" />
                                <span 
                                    class="text-slate-800 text-xs md:text-[14px] font-bold leading-9 group-hover:text-white transition-colors duration-300 ease-in-out">
                                    {{ $t('E-Learning') }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                
                
   


            </div>

    </div>
</template>

<script setup>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { faCar, faSeedling, faHomeAlt, faCartArrowDown, faCogs, faCog, faBook, faDollar } from '@fortawesome/free-solid-svg-icons';
    import { faScrewdriverWrench } from '@fortawesome/free-solid-svg-icons';
</script>

