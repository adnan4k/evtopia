<template>
 
    <div class="hero-section bg-cover bg-center h-72 flex items-center justify-center" 
    :style="{ backgroundImage: `url(${bannerImage})`, backgroundSize: 'cover', backgroundPosition: 'center' }">
          <h1 class="text-white text-3xl sm:text-4xl font-bold text-center">
            Who We Are
          </h1>
      </div>
    <!-- <div class="main-container  "> -->
        <!-- <AboutEvtopia/> -->

        <!-- <div class="grid grid-cols-1 md:grid-cols-3  gap-5 md:gap-10 pt-5 md:pt-10">
            <div class="flex flex-col items-center  w-full md:w-auto transform transition-transform duration-300 p-2 hover:scale-105
         hover:bg-gray-100">
                <span class="text-2xl md:text-4xl font-bold ">15 + </span> 
                <span class=" text-slate-600">
                    Years of Experience
                </span> 
            </div>
    
            <div class="flex flex-col items-center w-full md:w-auto transform transition-transform duration-300 p-2 hover:scale-105
         hover:bg-gray-100">
                <span class="text-2xl md:text-4xl font-bold">20 + </span> 
                <span class=" text-slate-600">
                    Brands Represented
                </span> 
            </div>
    
            <div class="flex flex-col items-center   w-full md:w-auto transform transition-transform duration-300 p-2 hover:scale-105
         hover:bg-gray-100  ">
                <span class="text-2xl md:text-4xl font-bold">200 + </span> 
                <span class=" text-slate-600">
                    Satisfied Customers
                </span> 
            </div>
        </div> -->



      
        <!-- <div class="text-xl mt-16 md:text-2xl font-bold text-slate-800 pb-2 md:pb-3 border-b">
            {{ content?.title }}
        </div>
        <div class="mt-6" v-html="content?.description"></div> -->
    <!-- </div> -->

    <div class="flex md:flex-row  flex-col  justify-between gap-8 md:gap-16 py-16 md:px-12">
        <div class="md:w-2/5 px-4">
            <p class="text-primary text-2xl">
                <strong> Brand</strong>
            </p>                                                                   
            
            The name <span class="text-primary font-bold" > "Evtopia" </span>  is a powerful fusion of "EV" (Electric Vehicle) and "Ethiopia," representing a visionary leap towards a sustainable and innovative future. It encapsulates the ambition to transform Ethiopia into a hub of green transportation, where electric vehicles become the norm, not the exception. "Evtopia" evokes the promise of a cleaner, more efficient world where cutting-edge technology meets Ethiopian ingenuity, driving economic growth and environmental stewardship. As a beacon of progress, Evtopia leads the charge in redefining the automotive landscape, setting a new standard for excellence and sustainability that resonates both locally and globally. 
            
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
                Brand Purpose
            </strong>
           </p>
            At Evtopia, our purpose is clear: to drive the future of electric mobility and shape a cleaner, greener world for generations to come. We believe that electric vehicles hold the key to a more sustainable transportation system, and we are committed to making electric mobility accessible, affordable, and efficient for everyone. Through innovation, sustainability, and empowerment, we are leading the charge towards a brighter future, one electric vehicle at a time.
            Together, we are redefining what it means to move forward, fostering a culture of progress that combines environmental responsibility with economic growth
        </div>
    </div>


    <div class="flex md:flex-row  flex-col  justify-between gap-8 md:gap-16 py-16 md:px-12">
        <div class="md:w-1/2 px-4 space-y-4">
            <p class="text-primary text-2xl">
                <strong> About US</strong>

            </p>
            <p>
                <strong>
                    Where the future of mobility meets the rich heritage of Ethiopia.
                </strong>
            </p>                                                                   
            
            <p>
                Evtopia Innovation and Technology PLC is a dynamic startup committed to revolutionizing transportation in East Africa through the adoption of electric vehicles (EVs) and sustainable mobility solutions. Founded with a vision to transform the automotive industry, Evtopia is dedicated to advancing electric mobility through innovation, sustainability, and empowerment.
            </p>            
            <p>
                Our cutting-edge website and app serve as a comprehensive platform designed to reshape Africa’s automotive landscape. We focus on promoting electric vehicles (EVs) while also supporting both EV and internal combustion engine (ICE) vehicle owners. By offering educational resources, community support, and easy access to services, Evtopia strives to simplify vehicle ownership, EV sales, and servicing. We are committed to encouraging sustainable automotive practices and driving the widespread adoption of EVs across Ethiopia and beyond.
            </p>
                <p>
                    The platform is designed to make the automotive market more accessible, efficient, and professional, ultimately benefiting users and the wider community. Evtopia aims to address critical issues such as traffic accidents, environmental challenges, energy efficiency, and innovation in the automotive sector.
                </p>
        </div>
        <div class="md:w-1/2 px-4 flex items-center">
            <img class="w-full rounded-lg" src="../assets/about_p.png" alt="">
        </div>
     
        
    </div>
    <div class="bg-[#beecbe]">
        <div class="main-container py-16">
            <!-- <h1 class="text-2xl px-2 md:text-xl text-center font-bold ">Empowering Your Electric Vehicle?</h1> -->
            <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">Our Mission, Vision & Goal</h1>
    
            <div class="grid grid-cols-1 md:grid-cols-3  gap-5 md:gap-10 pt-5 md:pt-10">
                <div class="border border-primary rounded-lg p-5 hover:scale-105 transform transition-transform duration-300">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faBullseye" class="h-[50px] text-primary"/>
                    </div>
                    <h2 class="text-2xl font-bold my-3">Our Mission</h2>
                    <p>
                        To revolutionize transportation through innovation, education and solving challenges through cutting-edge technology, and empowers communities across Africa.
                    </p>
    
                </div>

                <div class="border border-primary rounded-lg p-5 hover:scale-105 transform transition-transform duration-300">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faEye" class="h-[50px] text-primary"/>
                    </div>
                    <h2 class="text-2xl font-bold my-3">Our Vision</h2>
                    <p>
                      
                        To become Africa’s leading hub for electric vehicle (EV) innovation, and the premier automotive platform on the continent, fostering sustainable transportation solutions and driving technological advancement across the continent.
                    </p>
    
                </div>
                <div class="border border-primary rounded-lg p-5 hover:scale-105 transform transition-transform duration-300">
                    <div class="text-primary transition-colors duration-300 hover:text-indigo-600">
                        <font-awesome-icon :icon="faFlagCheckered" class="h-[50px] text-primary"/>
                    </div>
                    <h2 class="text-2xl font-bold my-3">Our Goal</h2>
                    <p>
                        To accelerate the adoption of electric vehicles (EVs) across Africa by providing innovative, sustainable, and accessible transportation solutions. 
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
                                👉 Innovation
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                Evtopia is committed to advancing electric mobility by exploring new ideas, technologies, and solutions to drive progress.
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                👉 Sustainability
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                We believe in building a cleaner, greener future and are dedicated to embedding sustainability into everything we do.
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                👉 Community
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                At Evtopia, we foster a supportive, inclusive, and informative environment, believing in the power of community to drive positive change.
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                👉 Empowerment
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                We enable individuals, organizations, and communities to embrace electric mobility through education, training, and access to cutting-edge solutions.
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                👉 Collaboration
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                Evtopia actively partners with like-minded individuals and organizations, recognizing that collaboration is key to achieving meaningful progress.
                            </div>
                        </div>
                
                        <div class="hover:scale-105 transform transition-transform duration-300">
                            <span class="font-bold text-xl">
                                👉 Transparency
                            </span>
                            <br>
                            <div class="text-gray-700 pl-10">
                                We operate with integrity and openness, ensuring that our users receive accurate, reliable information and services they can trust.
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
            <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">What We Offer </h1>
    
            <p class="text-center px-5 md:px-32">
                Evtopia provides a comprehensive range of products and services designed to support every facet of electric vehicle technology and sustainable transportation            </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10 pt-5 md:pt-10">
                    <!-- Consultation -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> Consultation </h3>
                        <p class="text-gray-700 pl-5">
                            Receive personalized advice from our experts to help you select the right EV based on your needs and preferences.
                        </p>
                    </div>
                
                    <!-- E-Commerce Marketplace -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> E-Commerce Marketplace </h3>
                        <p class="text-gray-700 pl-5">
                            Shop for electric vehicles, parts, accessories, and services from trusted suppliers—all in one convenient place.
                        </p>
                    </div>
                
                    <!-- E-Learning Programs -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> E-Learning Programs </h3>
                        <p class="text-gray-700 pl-5">
                            Engage with our online learning platform, offering self-paced courses on EV technology, maintenance, and sustainable transportation. These courses are designed to educate individuals, businesses, and government agencies on key aspects of electric mobility.
                        </p>
                    </div>
                
                      <!-- Training and Education -->
                      <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> Training and Education </h3>
                        <p class="text-gray-700 pl-5">
                            Education is key to accelerating the adoption of EVs. Our hands-on training programs are available both virtually and onsite, covering technical, practical, and foundational aspects of electric vehicle technology for individuals, businesses, and government entities.
                        </p>
                    </div>
                    <!-- EV Sales -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> EV Sales </h3>
                        <p class="text-gray-700 pl-5">
                            Explore our diverse range of affordable electric vehicles at competitive prices, with options to suit every budget.
                        </p>
                    </div>
                
                    <!-- After-Sales Service -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> After-Sales Service </h3>
                        <p class="text-gray-700 pl-5">
                            Benefit from comprehensive support, including maintenance, repairs, and customer service, ensuring a smooth and hassle-free EV ownership experience.
                        </p>
                    </div>
                
                  
                
                    <!-- Advanced Maintenance Services -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> Advanced Maintenance Services </h3>
                        <p class="text-gray-700 pl-5">
                            Access expert diagnostics and repairs for your electric vehicle to keep it running at its best.
                        </p>
                    </div>
                
                    <!-- Vehicle Conversion -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> Vehicle Conversion </h3>
                        <p class="text-gray-700 pl-5">
                            Turn your petrol or diesel vehicle into an electric one with our cost-effective and eco-friendly conversion services.
                        </p>
                    </div>
                
                    <!-- Informative and Educational Content -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> Informative and Educational Content </h3>
                        <p class="text-gray-700 pl-5">
                            Access a wealth of in-depth articles, tutorials, and videos that cover topics ranging from basic vehicle maintenance to the latest advancements in EV technology.
                        </p>
                    </div>
                
                    <!-- Community Engagement -->
                    <div class="hover:scale-105 transform transition-transform duration-300">
                        <h3 class="font-bold text-xl"> Community Engagement </h3>
                        <p class="text-gray-700 pl-5">
                            Become part of our vibrant community of automotive enthusiasts, where you can share insights, ask questions, and connect with like-minded individuals passionate about electric vehicles.
                        </p>
                    </div>
                </div>
                
            <div class="bg-[#98fb98] rounded-lg p-5 mt-10">
                <p class="border-l-4 border-primary pl-5 italic text-xl text-black">
                    “Evtopia seeks to drive significant societal and environmental impact by advancing technological solutions that contribute to a cleaner, more sustainable future for Africa’s transportation infrastructure.”
                </p>
            </div>
            
            
    
        </div>

    </div>


     <!-- Innovation and R&D Center -->
     <section class="py-10">
        <h2 class="text-3xl font-bold text-center mb-5">Innovation and R&D Center</h2>
        <p class="text-lg text-gray-700 mx-auto px-4 md:px-16">
            Our state-of-the-art innovation and research development facility, spanning over 10,000-meter square, will serve as the heart of our operations, where we conduct groundbreaking research on EV and autonomous transportation technologies. We are dedicated to pushing the boundaries of innovation and are proud to offer incubation and acceleration programs to empower startups in the automotive sector.        </p>
    </section>

    <!-- A Forward-Thinking Entrepreneur -->
    <section class="py-10 ">
        <div class="flex flex-col md:flex-row gap-5 px-4 md:px-16">
            <div class="w-full md:w-1/2 flex flex-col justify-center">
                <h2 class="text-3xl font-bold  mb-5">A Forward-Thinking Entrepreneur</h2>
                <p class="text-lg text-gray-700 text-justify ">
                    Evtopia was founded by <span class="font-bold text-primary">Isehak Kedir</span> , a visionary entrepreneur with a deep passion for automotive, innovation and sustainability. His forward-thinking approach and dedication to creating a sustainable future have been instrumental in establishing Evtopia as a pioneer in the Ethiopian market. Under his leadership, Evtopia is driving the adoption of EV technologies and fostering a culture of innovation and environmental responsibility.        
                </p>
            </div>
            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="../assets/founder.png" alt="">
            </div>
        </div>
       
    </section>

    <!-- Our Vision for the Future -->
    <section class="py-10">
        <h2 class="text-3xl font-bold text-center mb-5">Our Vision for the Future</h2>
        <p class="text-lg text-gray-700 mx-auto px-4 md:px-16">
            Evtopia is dedicated to leading the charge towards a sustainable future. Our short-term goals focus on developing brand awareness, establishing and launching core operations, completing the construction of our innovation and R&D center, building strategic partnerships, driving EV sales and service uptake, and increasing EV adoption.        </p>
        <p class="text-lg text-gray-700 mx-auto px-4 md:px-16 mt-4">
            In the long term, we aim to expand our research and development efforts, scale up our services, foster a thriving startup ecosystem, manufacture local EVs and mobilty solutions, achieve financial growth and stability, promote sustainability, and expand into other African markets.        </p>
    </section>

    <!-- Our Commitment -->

    <section class="py-10 ">
        <div class="flex flex-col md:flex-row gap-5 px-4 md:px-16">

            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="../assets/future.png" alt="">
            </div>
            <div class="w-full md:w-1/2 flex flex-col justify-center">
                <h2 class="text-3xl font-bold  mb-5">Our Commitment</h2>
                <p class="text-lg text-gray-700 ">
                    Evtopia is more than just a business; we are a movement towards a sustainable future. We believe in the power of innovation and the importance of environmental stewardship. Our team is passionate about making a positive impact, and we are committed to providing exceptional service and products that exceed our communities’ expectations.        
                </p>
    
            </div>
           
        </div>
       
    </section>

    <div class="flex justify-center">
        <a href="#" target="_blank" class="text-xl bg-primary px-3 py-2 rounded-md text-white font-bold text-center mb-5 mt-10">
            Join the Evtopia Movement
        </a>
    </div>

    <div class="bg-gray-10">
        <div class="main-container py-16">
            <!-- <h1 class="text-2xl px-2 md:text-xl text-center font-bold ">Empowering Your Electric Vehicle?</h1> -->
            <h1 class="text-2xl px-2 md:text-3xl text-center font-bold text-primary ">Contact Us</h1>
    
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
