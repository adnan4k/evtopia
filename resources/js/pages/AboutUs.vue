<template>
 
    <div class="hero-section bg-cover bg-center h-72 flex items-center justify-center" 
    :style="{ backgroundImage: `url(${bannerImage})`, backgroundSize: 'cover', backgroundPosition: 'center' }">
          <h1 class="text-white text-3xl sm:text-4xl font-bold text-center">
            {{ $t('who_we_are') }}
          </h1>
      </div>


    <div class="flex md:flex-row  flex-col  justify-between gap-8 md:gap-16 py-16 md:px-12">
        <div class="md:w-2/5 px-4">
            <p class="text-primary text-2xl">
                <strong> {{ $t('brand') }}</strong>
            </p>                                                                   
            
        <p v-html="$t('brand_description')"></p>
            
            
        </div>
        <div class="md:w-1/5 items-center">
            <div class="flex flex-col space-y-5 items-center justify-between">
                <img class="hover:scale-110 transform transition-transform duration-300" src="../assets/logo.png" alt="">
                 <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">EVTOPIA</h1>
            </div>
        </div>
        <div class="md:w-2/5 px-4">
           <p >
            <strong class="text-primary text-2xl">
                {{ $t('brand_purpose') }}
            </strong>
           </p>
            {{ $t('brand_purpose_description') }}
        </div>
    </div>


    <div class="flex md:flex-row  flex-col  justify-between gap-8 md:gap-16 py-16 md:px-12">
        <div class="md:w-1/2 px-4 space-y-4">
            <p class="text-primary text-2xl">
                <strong> {{ $t('about_us') }}</strong>

            </p>
            <p>
                <strong>
                    {{ $t('about_us_subheading') }}
                </strong>
            </p>                                                                   
            
            <p>
                {{ $t('about_us_paragraph1') }}            
            </p>            
            <p>
                {{ $t('about_us_paragraph2') }}
            </p>
                <p>
                    {{ $t('about_us_paragraph3') }}
                </p>
        </div>
        <div class="md:w-1/2 px-4 flex items-center">
            <img class="w-full rounded-lg" src="../assets/about_p.png" alt="">
        </div>
     
        
    </div>
    <div class="bg-[#beecbe]">
        <div class="main-container py-16">
            <!-- <h1 class="text-2xl px-2 md:text-xl text-center font-bold ">Empowering Your Electric Vehicle?</h1> -->
            <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">{{ $t('mission_vision_goal_title') }}</h1>
    
            <div class="grid grid-cols-1 md:grid-cols-3  gap-5 md:gap-10 pt-5 md:pt-10">
                <div class="border border-primary rounded-lg p-5 hover:scale-105 transform transition-transform duration-300">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faBullseye" class="h-[50px] text-primary"/>
                    </div>
                    <h2 class="text-2xl font-bold my-3">{{ $t('our_mission1') }}</h2>
                    <p>
                        {{ $t('our_mission_desc') }}
                    </p>
    
                </div>

                <div class="border border-primary rounded-lg p-5 hover:scale-105 transform transition-transform duration-300">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faEye" class="h-[50px] text-primary"/>
                    </div>
                    <h2 class="text-2xl font-bold my-3">{{ $t('our_vision') }}</h2>
                    <p>
                      
                       {{ $t('our_vision_desc') }}
                    </p>
    
                </div>
                <div class="border border-primary rounded-lg p-5 hover:scale-105 transform transition-transform duration-300">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faFlagCheckered" class="h-[50px] text-primary"/>
                    </div>
                    <h2 class="text-2xl font-bold my-3">{{ $t('our_goal') }}</h2>
                    <p>
                        {{ $t('our_goal_desc') }}
                    </p>
    
                </div>
                
            </div>
    
        </div>

    </div>

    
    <div class="bg-gray-50">
        <div class="main-container py-16">
            <!-- <h1 class="text-2xl px-2 md:text-xl text-center font-bold ">Empowering EV users with reliable products for a sustainable future</h1> -->
            <!-- <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">Our Core Values</h1> -->
    
            <div class="grid grid-cols-1 md:grid-cols-3  gap-5 md:gap-10 pt-5 md:pt-10">
                <div class="flex items-center col-span-1">
                    <img src="../assets/values.png" alt="">
                </div>

                <div class="flex items-center col-span-2">
                    <div class="flex flex-col gap-5">
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                {{ $t('value_innovation') }}
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                {{ $t('value_innovation_desc') }}
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                               {{ $t('value_sustainability') }}
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                {{ $t('value_sustainability_desc') }}
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                {{ $t('value_community') }}
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                {{ $t('value_community_desc') }}
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                {{ $t('value_empowerment') }}
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                {{ $t('value_empowerment_desc') }}
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                {{ $t('value_collaboration') }}
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                {{ $t('value_collaboration_desc') }}
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                {{ $t('value_transparency') }}
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                               {{ $t('value_transparency_desc') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
    
        </div>

    </div>


    <div class="bg-gray-50">
        <div class="main-container py-16">
            <!-- <h1 class="text-2xl px-2 md:text-xl text-center font-bold ">Empowering EV users with reliable products for a sustainable future</h1> -->
            <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">{{ $t('what_we_offer') }} </h1>
    
                <p class="text-center px-5 md:px-32">
                    {{ $t('offer_description') }}
                 </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10 pt-5 md:pt-10">
                    <!-- Consultation -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_consultation') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_consultation_desc') }}
                        </p>
                    </div>
                
                    <!-- E-Commerce Marketplace -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_marketplace') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_marketplace_desc') }}
                        </p>
                    </div>
                
                    <!-- E-Learning Programs -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_elearning') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_elearning_desc') }}
                        </p>
                    </div>
                
                      <!-- Training and Education -->
                      <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_training') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_training_desc') }}
                        </p>
                    </div>
                    <!-- EV Sales -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_sales') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_sales_desc') }}
                        </p>
                    </div>
                
                    <!-- After-Sales Service -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_aftersales') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_aftersales_desc') }}
                        </p>
                    </div>
                
                  
                
                    <!-- Advanced Maintenance Services -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_maintenance') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_maintenance_desc') }}
                        </p>
                    </div>
                
                    <!-- Vehicle Conversion -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_conversion') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_conversion_desc') }}
                        </p>
                    </div>
                
                    <!-- Informative and Educational Content -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_content') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_content_desc') }}
                        </p>
                    </div>
                
                    <!-- Community Engagement -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> {{ $t('offer_community') }} </h3>
                        <p class="text-gray-700 pl-5">
                            {{ $t('offer_community_desc') }}
                        </p>
                    </div>
                </div>
                
            <div class="bg-[#98fb98] rounded-lg p-5 mt-10">
                <p class="border-l-4 border-primary pl-5 italic text-xl text-black">
                    “{{ $t('impact_quote') }}”
                </p>
            </div>
            
            
    
        </div>

    </div>


     <!-- Innovation and R&D Center -->
     <section class="py-10">
        <h2 class="text-3xl font-bold text-center mb-5">{{ $t('innovation_center_title') }}</h2>
        <p class="text-lg text-gray-700 mx-auto px-4 md:px-16">
            {{ $t('innovation_center_desc') }}
         </p>
    </section>

    <!-- A Forward-Thinking Entrepreneur -->
    <section class="py-10 ">
        <div class="flex flex-col md:flex-row gap-5 px-4 md:px-16">
            <div class="w-full md:w-1/2 flex flex-col justify-center">
                <h2 class="text-3xl font-bold  mb-5">{{ $t('entrepreneur_title') }}</h2>
                <p class="text-lg text-gray-700 text-justify " v-html="$t('entrepreneur_desc')">
                </p>
            </div>
            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="../assets/founder.png" alt="">
            </div>
        </div>
       
    </section>

    <!-- Our Vision for the Future -->
    <section class="py-10">
        <h2 class="text-3xl font-bold text-center mb-5">{{ $t('vision_future_title') }}</h2>
        <p class="text-lg text-gray-700 mx-auto px-4 md:px-16">
           {{ $t('vision_future_desc1') }}
        </p>
        <p class="text-lg text-gray-700 mx-auto px-4 md:px-16 mt-4">
            {{ $t('vision_future_desc2') }}
         </p>
    </section>

    <!-- Our Commitment -->

    <section class="py-10 ">
        <div class="flex flex-col md:flex-row gap-5 px-4 md:px-16">

            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="../assets/future.png" alt="">
            </div>
            <div class="w-full md:w-1/2 flex flex-col justify-center">
                <h2 class="text-3xl font-bold  mb-5">{{ $t('commitment_title') }}</h2>
                <p class="text-lg text-gray-700 ">
                   {{ $t('commitment_desc') }}       
                </p>
    
            </div>
           
        </div>
       
    </section>

    <div class="flex justify-center">
        <a href="#" target="_blank" class="text-xl bg-primary px-3 py-2 rounded-md text-white font-bold text-center mb-5 mt-10">
            {{ $t('cta_join_movement') }}
        </a>
    </div>

    <div class="bg-gray-10">
        <div class="main-container py-16">
            <!-- <h1 class="text-2xl px-2 md:text-xl text-center font-bold ">Empowering Your Electric Vehicle?</h1> -->
            <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">{{ $t('contact_us') }}</h1>
    
            <div class="grid grid-cols-1 md:grid-cols-2  gap-5 md:gap-10 pt-5 md:pt-10">
                <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15760.940302505815!2d38.768228099999995!3d9.0423088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b8f7005555555%3A0x728914328fc59479!2sJan%20Meda%20Race%20Ground!5e0!3m2!1sen!2set!4v1731322453845!5m2!1sen!2set" 
                 class="w-full h-[420px]" style="border:0;" 
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                <div >
                    <form @submit.prevent="contactFormSubmit()">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2 order-2 md:order-1">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label mb-2">
                                            {{ $t('Full Name') }} <small class="text-red-500">*</small>
                                        </label>
                                        <input type="text" :placeholder="$t('Enter full name')" class="form-input"
                                            v-model="formData.name"
                                            :class="errors && errors?.name ? 'border-red-500' : 'border-slate-200'" />
                                        <span v-if="errors && errors?.name" class="text-red-500 text-sm">{{ errors?.name[0]
                                            }}</span>
                                    </div>
        
                                    <div>
                                        <label class="form-label mb-2">
                                            {{ $t('Phone Number') }} <small class="text-red-500">*</small>
                                        </label>
                                        <input type="text" :placeholder="$t('Enter phone number')" class="form-input"
                                            v-model="formData.phone"
                                            :class="errors && errors?.phone ? 'border-red-500' : 'border-slate-200'" />
                                        <span v-if="errors && errors?.phone" class="text-red-500 text-sm">{{ errors?.phone[0]
                                            }}</span>
                                    </div>
                                </div>
        
                                <div class="mt-4">
                                    <label class="form-label mb-2">
                                        {{ $t('Subject') }} <small class="text-red-500">*</small>
                                    </label>
                                    <input type="text" :placeholder="$t('Enter subject line')" class="form-input"
                                        v-model="formData.subject"
                                        :class="errors && errors?.subject ? 'border-red-500' : 'border-slate-200'" />
                                    <span v-if="errors && errors?.subject" class="text-red-500 text-sm">{{ errors?.subject[0]
                                        }}</span>
                                </div>
        
                                <div class="mt-4">
                                    <label class="form-label mb-2">
                                        {{ $t('Message') }} <small class="text-red-500">*</small>
                                    </label>
                                    <textarea rows="4" :placeholder="$t('Write your message') + ' ...'" class="form-input"
                                        v-model="formData.message"
                                        :class="errors && errors?.message ? 'border-red-500' : 'border-slate-200'"></textarea>
                                    <span v-if="errors && errors?.message" class="text-red-500 text-sm">
                                        {{ errors?.message[0] }}
                                    </span>
                                </div>
        
                                <div class="mt-4">
                                    <button type="submit"
                                        class="bg-primary text-white px-6 py-4 rounded-lg w-[148px]">{{ $t('Send') }}</button>
                                </div>
        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    
        </div>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import HeroBanner from "../components/HeroBanner.vue";
import AboutEvtopia from "../components/AboutEvtopia.vue";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faFlagCheckered, faEye, faBullseye, faF } from '@fortawesome/free-solid-svg-icons';
import { useToast } from "vue-toastification";
import { useAuth } from "../stores/AuthStore";

const toast = useToast();
const authStore = useAuth();

const formData = ref({
    name: '',
    phone: '',
    subject: '',
    message: '',
});

const errors = ref({});

const content = ref({});
import bannerImage from '../assets/about_banner.jpg';

const banner = ref([]);

const contactFormSubmit = () => {
    validateForm();

    if (formData.value.name && formData.value.phone && formData.value.subject && formData.value.message) {
        axios.post('/support', formData.value, {
            headers: {
                'Authorization': authStore.token
            }
        }).then((response) => {
            toast.success(response.data.message,{
                position: "bottom-left",
            });
            formData.value.name = '';
            formData.value.phone = '';
            formData.value.subject = '';
            formData.value.message = '';
            errors.value = {};
        }).catch((error) => {
            errors.value = error.response.data.errors
            toast.error(error.response.data.message, {
                position: "bottom-left",
            });
        })
    }
}

const validateForm = () => {
    if (!formData.value.name) {
        errors.value.name = ['Name is required.'];
    }
    if (!formData.value.phone) {
        errors.value.phone = ['Phone number is required.'];
    }
    if (!formData.value.subject) {
        errors.value.subject = ['Subject is required.'];
    }
    if (!formData.value.message) {
        errors.value.message = ['Message is required.'];
    }

}
onMounted(() => {
    fetchData();
    getData();
    window.scrollTo(0, 0);
});



const getData = () => {
    axios.get('/home?page=1&per_page=12', {
        headers: {
            Authorization: authStore.token
        }
    }).then((response) => {
        banner.value = response.data.data.banners;
    }).catch(() => {});
}

const fetchData = () => {
    axios.get('/legal-pages/about-us').then((response) => {
        content.value = response.data.data.content;
    });
}

</script>

<style scoped>
.form-label {
    @apply text-slate-700 text-base font-normal leading-normal block;
}

.form-input {
    @apply p-3 rounded-lg border focus:border-primary w-full outline-none text-base font-normal leading-normal placeholder:text-slate-400;
}
</style>
