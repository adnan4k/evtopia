<template>
    <div class="flex md:flex-row  px-4 flex-col items-center justify-between gap-8 md:gap-16 md:px-12">
        <div class="md:w-1/2 items-center">
                <h2 class="text-2xl block hover:scale-105 transform duration-300 delay-100 ease-in-out md:hidden font-bold animate-border_about">
                    {{ $t('welcome_to_evtopia') }} 
                    <!-- <span class="text-primary">{{ $t('evtopia1') }}</span> -->
                </h2>
            <img class="w-full mt-5 rounded-lg" src="../assets/about_p.png" alt="">
            
        </div>
        <div class="md:w-1/2">
            <h2 class="text:2xl md:text-3xl  lg:text-4xl  hover:scale-105 transform duration-300 delay-100 ease-in-out mb-10 hidden  font-bold md:block md:animate-border_about">
                    {{ $t('welcome_to_evtopia') }} 
                <!-- <span class="text-primary">{{ $t('evtopia1') }}</span> -->
            </h2>
            <!-- <p class="mt-2 ">
                <strong class="text-muted">
                    Empowering EV users with reliable products for a sustainable future.
                </strong>
            </p> -->
            <p class=" text-justify text-xl mb-5 mt-5 text-gray-600">
                {{ $t('evtopia_intro') }}
            </p>
                <div class="bg-[#98fb98] rounded-lg p-5 mt-1">
                    <p class="border-l-4 border-primary pl-5 italic text-black">
                        “{{ $t('our_mission') }}”
                    </p>
                </div>
        </div>
    </div>
</template>



