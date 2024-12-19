<template>
  <div class="space-y-4 mt-3 transition duration-300">
    <div
      v-for="serv in serviceStore.services"
      :key="serv.id"
      class="px-4 py-3 bg-slate-50 rounded-xl border border-slate-100"
    >
   

      <div class="space-y-2 divide-y divide-slate-200">
        <!-- item 1-->
        <div
        
          class="flex gap-4 justify-start w-full items-center pt-1"
        >
          <div class="w-[72px] h-[95px]">
            <img
              :src="serv.service.thumbnail"
              class="w-full h-full object-contain"
            />
          </div>
          <div class="flex flex-col gap-1 w-full">
        
            <!-- Product Name -->
            <div class="text-slate-950 text-base font-normal leading-normal">
              {{ serv.service.name }}
            </div>
            <div class="flex flex-wrap justify-between items-center gap-3">
             
              <div>
                
              </div>
              <div class="text-slate-800 text-base font-normal leading-normal">
                {{ serv.quantity }} X
                {{
                  master.showCurrency(
                    serv.service.discounted_price > 0
                      ? serv.service.discounted_price
                      : serv.service.price
                  )
                }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuth } from "../stores/AuthStore";
import { useMaster } from "../stores/MasterStore";
import { useServiceStore } from "../stores/ServiceStore";

const AuthStore = useAuth();
const master = useMaster();
const serviceStore = useServiceStore();

</script>

<style lang="scss" scoped></style>
