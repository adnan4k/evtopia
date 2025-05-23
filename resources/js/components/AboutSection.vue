<template>
  <section
    id="why-evtopia"
    class="py-32 bg-white overflow-hidden"
  >
    <div class="max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Intro row (fades/slides once) -->
      <div
        class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center transition-all duration-700"
        :class="isShown
          ? 'opacity-100 translate-y-0'
          : 'opacity-0 translate-y-10'"
      >
        <!-- label + headline -->
        <div>
          <span
            class="font-semibold uppercase text-primary tracking-wide block"
            >{{ $t('evtopia') }}</span
          >
          <h1 class="mt-2 text-4xl font-extrabold text-gray-900">
            {{ $t('Building Ethiopia\'s EV Future') }}

          </h1>
        </div>

        <!-- quote -->
        <blockquote
          class="relative pl-14 py-4 text-lg leading-relaxed text-gray-600 italic"
        >
          <BoltIcon
            class="absolute left-0 top-2 left-5 text-primary w-8 h-8"
            aria-hidden="true"
          />

        {{ $t('the_first_of_its_kind') }}

        </blockquote>
      </div>

      <!-- Features row -->
      <div
        class="mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
      >
        <!-- CARD component -->
        <div
          v-for="(feature, i) in features"
          :key="i"
          class="flex flex-col gap-3 p-6 rounded-lg shadow-lg bg-white
                 transition-transform duration-300 ease-out
                 transform
                 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-2xl
                 focus-visible:-translate-y-3 focus-visible:scale-[1.03] focus-visible:shadow-2xl
                 outline-none"
          tabindex="0"
          :style="{ transitionDelay: isShown ? `${i * 120}ms` : '0ms' }"
          :class="isShown
            ? 'opacity-100 translate-y-0'
            : 'opacity-0 translate-y-10'"
        >
          <!-- icon -->
          <component
            :is="feature.icon"
            class="h-20 w-20 text-primary"
          />

         <h3 class="text-xl font-semibold text-gray-900">
          {{ $t(feature.title) }}
        </h3>
        <p class="mt-2 text-gray-600 text-[17px] py-1">
          {{ $t(feature.body) }}
        </p>

        </div>
      </div>
    </div>

    <div
      id="ev-blocks"
      class="max-w-[100rem] sm:px-6 lg:px-8 mt-20 mx-auto grid gap-6 md:grid-cols-12 hidden"
    >
      <div
        v-for="(b, i) in blocks"
        :key="b.title"
        class="relative group overflow-hidden rounded-lg text-white shadow-md
               transition duration-500 ease-out transform
               mx-4 sm:mx-2
               hover:-translate-y-2 hover:shadow-xl
               flex flex-col justify-between"
        :class="[
          b.color,
          `md:row-span-${b.tier}`,
          i % 2 === 0 ? 'md:col-span-6' : 'md:col-start-7 md:col-span-6',
          isShown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'
        ]"
        :style="{ transitionDelay: show ? `${i * 120}ms` : '0ms' }"
      >
        <div class="p-6 space-y-3">
          <component :is="b.icon" class="w-8 h-8" />
          <h3 class="text-lg font-semibold">{{ b.title }}</h3>
          <p class="text-sm leading-relaxed">
            {{ b.body }}
          </p>
        </div>

        <div
          class="hidden md:block absolute bottom-0 left-1/2 -translate-x-1/2
                 w-8 h-8 bg-inherit rotate-45 origin-top"
        />
      </div>
    </div>
  
  </section>
</template>

<script setup>

import { onMounted, ref } from 'vue'

/* Heroicons you already use */
import {
  Squares2X2Icon,
  WrenchScrewdriverIcon,
  AcademicCapIcon,
  BoltIcon
} from '@heroicons/vue/24/solid'

import {
  TruckIcon,
  WrenchIcon,
  CubeTransparentIcon,
  BuildingStorefrontIcon,
  Cog6ToothIcon,
} from '@heroicons/vue/24/outline'

/* track “visible” state so we can animate only once */
const isShown = ref(false)

onMounted(() => {
  const el = document.getElementById('why-evtopia')
  const io = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        isShown.value = true
        io.disconnect()
      }
    },
    { threshold: 0.3 }
  )
  io.observe(el)
})


/* data + icon map */
const blocks = [
  {
    title: 'Service Providers',
    body: 'Offering maintenance and support for EV users.',
    icon: WrenchIcon,
    color: 'bg-green-800',
    tier: 3, // how “tall” (3 = tallest)
  },
  {
    title: 'Comprehensive Support',
    body: 'Delivering consultancy, sales, and after-sales services.',
    icon: Cog6ToothIcon,
    color: 'bg-green-700',
    tier: 4,
  },
  {
    title: 'Buyers & Sellers',
    body: 'Connecting buyers and sellers in the EV marketplace.',
    icon: BuildingStorefrontIcon,
    color: 'bg-green-700',
    tier: 2,
  },
  {
    title: 'E-learning',
    body:
      'Through an innovative e-learning platform, Evtopia empowers and certifies our community.',
    icon: AcademicCapIcon,
    color: 'bg-green-900',
    tier: 2,
  },
  {
    title: 'Manufacturing',
    body: 'Supporting local EV manufacturing and innovation.',
    icon: CubeTransparentIcon,
    color: 'bg-green-900',
    tier: 1,
  },
  {
    title: 'Importers',
    body: 'Facilitating importation of EVs and components.',
    icon: TruckIcon,
    color: 'bg-green-800',    
    tier: 1,
  },
]
/* feature data & icon mapping */

//  "comprehensive_support": "Comprehensive Support for EV Adoption",
//     "comprehensive_support_desc": "We offer expert consultancy, advice, sales, after-sales services, and access to quality spare parts.",
//     "education_empowerment": "Empowering Through Education",
//     "education_empowerment_desc": "Through an innovative e-learning platform, Evtopia empowers users with automotive knowledge and certifications, fostering local skills development and workforce readiness in the growing EV sector.",
//     "centralized_ecosystem": "Centralized EV Ecosystem",
//     "centralized_ecosystem_desc": "The first-of-its-kind platform in Ethiopia, uniting EV suppliers, importers, buyers, sellers, manufacturers, and service providers."

const features = [
  {
    title: 'comprehensive_support',
    body:
      'comprehensive_support_desc',
    icon: Squares2X2Icon
  },
  {
    title: 'education_empowerment',
    body:
      'education_empowerment_desc',
    icon: AcademicCapIcon
  },
  {
    title: 'centralized_ecosystem',
    body:
      'centralized_ecosystem_desc',
    icon: WrenchScrewdriverIcon
  }
]
</script>

<style scoped>
/* ensure opacity + transform animate together */
div[id='ev-blocks'] > div {
  transition-property: opacity, transform;
}
</style>
