<template>
    <div class="mt-10">
        <h1 class="text-2xl px-2 md:text-5xl text-center font-bold text-primary animate-border">Why Electric Vehicles?</h1>
        <div class="grid grid-cols-1 lgx:grid-cols-2 gap-20 py-16 px-3 md:px-28">
            <div class="hidden lgx:flex items-center">
                <img class="w-full transform transition-transform duration-300 hover:scale-100" src="./../assets/why.png" alt="">
            </div>
            <div class="grid grid-cols-1 gap-4">
                <!-- Feature Item Start -->
                <div class="flex gap-4 items-center lgx:-ml-10 transform transition-transform duration-300 hover:scale-105
                 hover:bg-gray-100 p-1 rounded-lg">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faShieldHalved" class="h-[50px] text-primary"/>
                    </div>
                    <div class="text-slate-800">
                        <h1 class="text-xl  font-bold">Safety</h1>
                        <p class="text-slate-700 text-[16px]  md:pr-20 pt-1 ">
                            Electric Cars are extremely reliable and secure. After all, electricity is not flammable!
                        </p>
                    </div>
                </div>
                <!-- Feature Item End -->
        
                <!-- Repeat for Other Items -->
                <div class="flex gap-4 items-center lgx:ml-5 transform transition-transform duration-300 hover:scale-105
                 hover:bg-gray-100 p-1 rounded-lg">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faChargingStation" class="h-[50px] text-primary"/>
                    </div>
                    <div class="text-slate-800">
                        <h1 class="text-xl md:text-2xl font-bold">Fuel Cost</h1>
                        <p class="text-slate-700 text-[16px]  md:pr-20 pt-1 ">
                            Electricity is known for its relatively cheap cost and, as a result, will be much more affordable.
                        </p>
                    </div>
                </div>
        
                <!-- Additional feature items below (use similar structure and classes) -->
                <div class="flex gap-4 items-center lgx:ml-10 transform transition-transform duration-300 hover:scale-105
                 hover:bg-gray-100 p-1 rounded-lg">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faCar" class="h-[50px] text-primary"/>
                    </div>
                    <div class="text-slate-800">
                        <h1 class="text-xl md:text-2xl font-bold">Driver Fatigue & Silence</h1>
                        <p class="text-slate-700 text-[16px]  md:pr-20 pt-1 ">
                            Less noise means living in large cities with electric cars is much more comfortable.
                        </p>
                    </div>
                </div>
        
                <div class="flex gap-4 items-center lgx:ml-5 transform transition-transform duration-300 hover:scale-105
                 hover:bg-gray-100 p-1 rounded-lg">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faScrewdriverWrench" class="h-[50px] text-primary"/>
                    </div>
                    <div class="text-slate-800">
                        <h1 class="text-xl md:text-2xl font-bold">Maintenance</h1>
                        <p class="text-slate-700 text-[16px]  md:pr-20 pt-1 ">
                            Simplified design – repairs are less expensive and take less time.
                        </p>
                    </div>
                </div>
        
                <div class="flex gap-4 items-center lgx:-ml-10 transform transition-transform duration-300 hover:scale-105
                 hover:bg-gray-100 p-1 rounded-lg">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faSeedling" class="h-[50px] text-primary"/>
                    </div>
                    <div class="text-slate-800">
                        <h1 class="text-xl md:text-2xl font-bold">Environment</h1>
                        <p class="text-slate-700 text-[16px]  md:pr-20 pt-1 ">
                            Owners of electric or hybrid vehicles have a much lower cost to run. The fuel cost to run an EV is roughly one third the cost of a gasoline-powered car.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faChargingStation, faSeedling, faShieldHalved } from '@fortawesome/free-solid-svg-icons';
import { faCar } from '@fortawesome/free-solid-svg-icons';
import { faScrewdriverWrench } from '@fortawesome/free-solid-svg-icons';
</script>

<style lang="scss" scoped>

</style>
