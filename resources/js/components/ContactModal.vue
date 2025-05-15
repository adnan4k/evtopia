<template>
  <transition name="fade">
    <div
      v-if="isOpen"
      class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center"
      @click.self="close"
    >
      <transition name="scale-fade">
        <div
          v-if="isOpen"
          class="m-4 bg-white rounded-lg p-6 w-full max-w-md relative shadow-lg"
        >
          <button
            @click="close"
            class="absolute top-2 right-2 text-gray-700 hover:text-black text-xl"
          >
            ×
          </button>
          <h2 class="text-xl font-bold text-center underline text-primary mb-4">
            Contact Information
          </h2>

          <div class="space-y-5 text-black">
            <p>
              <strong>Email:</strong>
              <a :href="'mailto:' + masterData.email">{{ masterData.email }}</a>
            </p>
            <p>
              <strong>Phone:</strong>
              <a :href="'tel:' + masterData.mobile">{{ masterData.mobile }}</a>
            </p>
          </div>

          <div class="flex justify-center flex-wrap gap-4 mt-10">
            <a
              v-for="link in masterData.social_links"
              :key="link.name"
              :href="link.link"
              target="_blank"
              class="w-10 h-10"
            >
              <img
                :src="link.logo"
                alt="social"
                class="w-full h-full object-cover rounded-full"
              />
            </a>
          </div>
        </div>
      </transition>
    </div>
  </transition>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  masterData: Object,
});

const isOpen = ref(false);

const open = () => (isOpen.value = true);
const close = () => (isOpen.value = false);

defineExpose({ open, close });
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.scale-fade-enter-active,
.scale-fade-leave-active {
  transition: transform 0.3s ease, opacity 0.3s ease;
}
.scale-fade-enter-from,
.scale-fade-leave-to {
  opacity: 0;
  transform: scale(0.9);
}
</style>
