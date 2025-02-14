<template>
    <div class="md:py-8">
        <div class="grid grid-cols-1 lgx:grid-cols-7 gap-5 py-8 px-3 md:px-16">
           
            <div class="lgx:col-span-4 flex flex-col justify-center">
                <h1 class="text-3xl md:text-4xl font-bold text-primary animate-border_start"> Why Choose Evtopia?</h1>
                <!-- <p class="text-slate-700  text-justify pt-1 md:pt-3">
                    We are a passionate group of electric vehicle (EV) enthusiasts dedicated to advancing and sharing knowledge about the benefits of EVs. From environmental advantages to cutting-edge technology, we see electric vehicles as the future of sustainable transportation. By staying informed on the latest innovations, we aim to inspire others to explore and embrace this eco-friendly alternative.
                </p> -->
                <!-- <p class="text-slate-700 font-bold  text-justify pt-3 pb-1">
                   Showcase unique selling points for each group:
                </p>
                <div class="pl-2 flex flex-col gap-1">
                    <p >
                       <strong class="text-primary">
                        <font-awesome-icon :icon="faCheck" class="text-primary"/>
                        Buyers : 
                       </strong> Competitive pricing, verified sellers, and fast delivery.
                    </p>

                    <p >
                        <strong class="text-primary">
                            <font-awesome-icon :icon="faCheck" class="text-primary"/>
                            Sellers : 
                        </strong> Reach EV enthusiasts globally, free listings, sales analytics.
                     </p>

                     <p >
                        <strong class="text-primary">
                            <font-awesome-icon :icon="faCheck" class="text-primary"/>
                            Dealers : 
                        </strong> Platform to showcase inventory, connect with a growing EV audience.
                     </p>

                     <p >
                        <strong class="text-primary">
                            <font-awesome-icon :icon="faCheck" class="text-primary"/>
                            Community : 
                        </strong> Events, forums, and shared goals for sustainability.
                     </p>
                </div> -->



                <!-- <p class="text-slate-700 font-bold  text-justify pt-3 pb-1">
                    Benefits of shopping on Evtopia:
                 </p> -->
                 <!-- <div class="pl-5 flex flex-col gap-1">
                     <p >
                        <strong class="text-primary">
                         Buyers : 
                        </strong> Competitive pricing, verified sellers, and fast delivery.
                     </p>
 
                     <p >
                         <strong class="text-primary">
                             Sellers : 
                         </strong> Reach EV enthusiasts globally, free listings, sales analytics.
                      </p>
 
                      <p >
                         <strong class="text-primary">
                             Dealers : 
                         </strong> Platform to showcase inventory, connect with a growing EV audience.
                      </p>
 
                      <p >
                         <strong class="text-primary">
                             Community : 
                         </strong> Events, forums, and shared goals for sustainability.
                      </p>
                 </div> -->
                <!-- <ul class="list-none  text-black gap-1">
                    <li class="flex items-center gap-3  font-bold">
                        <font-awesome-icon :icon="faUsers" class="text-primary"/>
                        Trusted by 10,000+ EV Enthusiasts</li>
                    <li class="flex items-center gap-3  font-bold">
                        <font-awesome-icon :icon="faHandshakeAlt" class=" text-primary"/>
                        Eco-Friendly Marketplace</li>
                    <li class="flex items-center gap-3  font-bold">
                        
                        <font-awesome-icon :icon="faShieldAlt" class=" text-primary"/>
                        Secure Payments</li>
                    <li class="flex items-center gap-3  font-bold">
                        
                        <font-awesome-icon :icon="faCheckSquare" class=" text-primary"/>
                        Quality assurance and Fast delivery</li>
                    <li class="flex items-center gap-3  font-bold">
                        <font-awesome-icon :icon="faChain" class=" text-primary"/>
                        Wide selection and competitive pricing </li>
                </ul> -->

                <div class="transform mt-4 py-1 transition-transform duration-300">
                    <h3 class="font-bold ">Centralized EV Ecosystem</h3>
                    <p class="text-gray-700 pl-2">
                        The first-of-its-kind platform in Ethiopia, uniting EV suppliers, importers, buyers, sellers, manufacturers, and service providers.
                    </p>
                </div>
                
                <div class="transform py-1 transition-transform duration-300">
                    <h3 class="font-bold ">Comprehensive Support for EV Adoption</h3>
                    <p class="text-gray-700 pl-2">
                        We offer expert consultancy, advice, sales, after-sales services, and access to quality spare parts.
                    </p>
                </div>
                
                <div class="transform py-1 transition-transform duration-300">
                    <h3 class="font-bold ">Empowering Through Education</h3>
                    <p class="text-gray-700 pl-2">
                        Through an innovative e-learning platform, Evtopia empowers users with automotive knowledge and certifications, fostering local skills development and workforce readiness in the growing EV sector.
                    </p>
                </div>
                
                <!-- <div class="transform py-1 transition-transform duration-300">
                    <h3 class="font-bold ">Centralized Market Accessibility</h3>
                    <p class="text-gray-700 pl-2">
                        Simplifies Ethiopia's fragmented automotive market by providing a reliable, professional, and user-friendly platform for buying, maintaining, and learning about vehicles.
                    </p>
                </div> -->
                
                <div class="transform py-1 transition-transform duration-300">
                    <h3 class="font-bold ">Commitment to Safety and Sustainability</h3>
                    <p class="text-gray-700 pl-2">
                        Addresses critical challenges like traffic accidents and environmental pollution by promoting energy-efficient vehicles, safer roads, and eco-conscious driving practices.
                    </p>
                </div>
                
                <div class="transform py-1 transition-transform duration-300">
                    <h3 class="font-bold ">Innovation and R&D Hub</h3>
                    <p class="text-gray-700 pl-2">
                        Developing a 10,000-square-meter innovation and R&D center to create tailored solutions for Ethiopia, drive local innovation, and advance EV infrastructure and industry across Africa.
                    </p>
                </div>
                
                <!-- <div class="transform py-1 transition-transform duration-300">
                    <h3 class="font-bold ">Alignment with National and Global Goals</h3>
                    <p class="text-gray-700 pl-2">
                        Accelerating Ethiopia’s target of 90% EV adoption by 2030 and contributing to global sustainability efforts, Evtopia drives meaningful change locally and internationally.
                    </p>
                </div> -->
                
            </div>
            

            <div class="lgx:col-span-3 flex items-center">
                <img class="w-full lgx:h-[600px]" src="./../assets/about.PNG" alt="">
            </div>
        </div>
        

    </div>
</template>

<script setup>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { faChain, faCheck, faCheckSquare, faHandshakeAlt, faMoneyBill, faSeedling, faShieldAlt, faShieldHalved, faSquareCheck, faUsers } from '@fortawesome/free-solid-svg-icons';
    import { faCar } from '@fortawesome/free-solid-svg-icons';
    import { faScrewdriverWrench } from '@fortawesome/free-solid-svg-icons';
import { ArrowRightCircleIcon } from '@heroicons/vue/24/solid';
</script>

