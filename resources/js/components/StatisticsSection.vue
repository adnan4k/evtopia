<template>
    <div class="py-16 bg-[#30602A] px-3 md:px-8 xlg:px-16">
        <h1 class="text-2xl md:text-4xl font-bold text-white animate-border_start">
            Over 10 Years, We Sell Electric Cars. 
        </h1>

        <div class="pt-8">
            <div class="grid grid-cols-1  xmd:grid-cols-2 lg:grid-cols-2 xlg:grid-cols-4 ">

                <!-- Feature Item Start -->
                 <div class="flex justify-center mt-10 xmd:mt-5 xmd:justify-start">
                     <div class="flex gap-4 items-center  justify-center transform transition-transform duration-300 hover:scale-105
                      hover:bg-primary/5 rounded-lg">
                         <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                             <font-awesome-icon :icon="faCar" class="h-[50px] text-white"/>
                         </div>
                         <div class="text-slate-100">
                             <h1 class="text-xl  font-bold">15514 + </h1>
                             <p class="text-slate-100  pt-1 md:pt-3">
                                 Cars sold
                             </p>
                         </div>
                     </div>
                 </div>
                <!-- Feature Item End -->

                <!-- Feature Item Start -->
                 <div class="flex justify-center mt-10 xmd:mt-5 xmd:justify-end">
                     <div class="flex gap-4 items-center  justify-center transform transition-transform duration-300 hover:scale-105
                      hover:bg-primary/5 rounded-lg">
                         <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                             <font-awesome-icon :icon="faCarSide" class="h-[50px] text-white"/>
                         </div>
                         <div class="text-slate-100">
                             <h1 class="text-xl  font-bold">1201 + </h1>
                             <p class="text-slate-100  md:pr-20 pt-1 md:pt-3">
                                 Cars for sale
                             </p>
                         </div>
                     </div>
                 </div>
                <!-- Feature Item End -->


                <!-- Feature Item Start -->
                <div class="flex justify-center mt-10 xmd:mt-5 xmd:justify-start">
                    <div class="flex gap-4 items-center  justify-center transform transition-transform duration-300 hover:scale-105
                    hover:bg-primary/5 rounded-lg">
                        <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                            <font-awesome-icon :icon="faMessage" class="h-[50px] text-white"/>
                        </div>
                        <div class="text-slate-100">
                            <h1 class="text-xl  font-bold">2150 + </h1>
                            <p class="text-slate-100  md:pr-20 pt-1 md:pt-3">
                                Reviews
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature Item End -->


                <!-- Feature Item Start -->
                 
                <div class="flex justify-center mt-10 xmd:mt-5 xmd:justify-end">
                    <div class="flex gap-4 items-center  justify-center transform transition-transform duration-300 hover:scale-105
                    hover:bg-primary/5 rounded-lg">
                        <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                            <font-awesome-icon :icon="faUsers" class="h-[50px] text-white"/>
                        </div>
                        <div class="text-slate-100">
                            <h1 class="text-xl  font-bold">3800 + </h1>
                            <p class="text-slate-100  md:pr-20 pt-1 md:pt-3">
                                Visitors/Day
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Feature Item End -->

            </div>
        </div>
    </div>
    <hr class="w-16 md:w-96 mx-auto border-t-4 border-primary rounded-full">

    <div class="bg-primary">

        <div class="grid text-white grid-cols-1 md:grid-cols-3 gap-3 md:gap-10 py-16 px-3 md:px-8 xlg:px-12 xlg:gap-10" >
            <div class="card border px-4 py-4 rounded-md transform transition-transform duration-300 hover:scale-105">
                <h1 class="text-2xl font-bold ">Financing Made Easy</h1>
                <p class=" pt-1 md:pt-3">
                    Distillery succulents twee leggings thundercats. Shabby chic ramps gochujang pickled. Etsy offal literally fingerstache pickled, pork belly mlkshk irony tumeric.
                </p>
            </div>
    
            <div class="card border px-4 py-4 rounded-md transform transition-transform duration-300 hover:scale-105">
                <h1 class="text-2xl font-bold ">Trusted By Thousands</h1>
                <p class=" pt-1 md:pt-3">
                    Distillery succulents twee leggings thundercats. Shabby chic ramps gochujang pickled. Etsy offal literally fingerstache pickled, pork belly mlkshk irony tumeric.
                </p>
            </div>
    
            <div class="card border px-4 py-4 rounded-md transform transition-transform duration-300 hover:scale-105">
                <h1 class="text-2xl font-bold ">Wide Range Of Brands</h1>
                <p class=" pt-1 md:pt-3">
                    Distillery succulents twee leggings thundercats. Shabby chic ramps gochujang pickled. Etsy offal literally fingerstache pickled, pork belly mlkshk irony tumeric.
                </p>
            </div>
        </div> 
    </div>
</template>

<script setup>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { faCheck, faSeedling, faShieldHalved } from '@fortawesome/free-solid-svg-icons';
    import { faCar,faMessage,faUsers,faCarSide } from '@fortawesome/free-solid-svg-icons';
    import { faScrewdriverWrench } from '@fortawesome/free-solid-svg-icons';
</script>

