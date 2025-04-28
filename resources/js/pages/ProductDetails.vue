<template>
    <div class="main-container">

        <div v-if="loading" class="space-y-6 animate-pulse">
      <!-- Breadcrumbs skeleton -->
      <div class="flex items-center gap-2 pt-4">
        <div class="w-6 h-6 bg-slate-200 rounded"></div>
        <div class="flex-1 h-4 bg-slate-200 rounded"></div>
      </div>

      <!-- Hero slider skeleton -->
      <div class="w-full h-96 bg-slate-200 rounded-xl"></div>
      <div class="grid grid-cols-4 gap-2">
        <div v-for="i in 4" :key="i" class="h-24 bg-slate-200 rounded"></div>
      </div>

      <!-- Title & model skeleton -->
      <div class="space-y-2 lg:pl-6">
        <div class="h-8 bg-slate-200 rounded w-1/2"></div>
        <div class="h-4 bg-slate-200 rounded w-1/4"></div>
      </div>

      <!-- Short description skeleton -->
      <div class="h-4 bg-slate-200 rounded w-full"></div>
      <div class="h-4 bg-slate-200 rounded w-5/6"></div>

      <!-- Stats row skeleton (range, battery, year) -->
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div v-for="i in 3" :key="i" class="h-6 bg-slate-200 rounded"></div>
      </div>

      <!-- Price & discount skeleton -->
      <div class="flex items-center gap-4">
        <div class="h-10 bg-slate-200 rounded w-32"></div>
        <div class="h-6 bg-slate-200 rounded w-20"></div>
      </div>

      <!-- Action buttons skeleton -->
      <div class="flex gap-4">
        <div class="h-10 bg-slate-200 rounded flex-1"></div>
        <div class="h-10 bg-slate-200 rounded flex-1"></div>
      </div>

      <!-- Related products heading skeleton -->
      <div class="mt-6 h-6 bg-slate-200 rounded w-1/4"></div>

      <!-- Related products grid skeleton -->
      <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-3">
        <div v-for="i in 5" :key="i" class="h-48 bg-slate-200 rounded"></div>
      </div>
    </div>


        <div v-else>
            <div  class="grid grid-cols-1 xl:grid-cols-4">
    
                <div class="xl:col-span-3 col-span-1 lg:pr-6">
    
                    <div class="flex items-center gap-2 overflow-hidden pt-4">
                        <router-link to="/" class="w-6 h-6">
                            <HomeIcon class="w-5 h-5 text-slate-600" />
                        </router-link>
    
                        <div class="grow w-full overflow-hidden">
                            <div class="space-x-1 text-slate-600 text-sm font-normal truncate">
                                <router-link to="/">{{ $t('Home') }}</router-link>
                                <span>/</span>
                                <span>{{ product.name }}</span>
                            </div>
                        </div>
                    </div>
    
                    <div class="flex flex-wrap lg:flex-nowrap gap-4 mt-6">
                        <div class="lg:w-[480px] w-full">
    
                            <div class="w-full">
                                <div class="bg-slate-50 rounded-xl border border-slate-100 px-6">
                                    <swiper :spaceBetween="10" :thumbs="{ swiper: thumbsSwiper }" :modules="modules"
                                        class="product-details-slider">
                                        <swiper-slide v-for="thumbnail in product.thumbnails" :key="thumbnail.id"
                                            class="max-h-[448px] h-auto">
                                            <img :src="thumbnail.thumbnail" alt="" class="h-full w-full object-contain">
                                        </swiper-slide>
                                    </swiper>
                                </div>
                                <div class="px-1 mt-2">
                                    <swiper @swiper="setThumbsSwiper" :spaceBetween="10" :slidesPerView="4" :freeMode="true"
                                        :navigation="true" :watchSlidesProgress="true" :modules="modules"
                                        class="product-details-thumbnail">
                                        <swiper-slide v-for="thumbnail in product.thumbnails" :key="thumbnail.id">
                                            <img :src="thumbnail.thumbnail" alt="" class="h-full w-full object-cover">
                                        </swiper-slide>
                                    </swiper>
                                </div>
    
                            </div>
    
                        </div>
    
                        <div class="">
    
                            <!-- Brand -->
                            <span v-if="product.categories && product.categories.length"
                                v-for="(category, index) in product.categories" :key="index"
                                class="text-primary text-xs font-normal leading-none px-1.5 py-1 bg-primary-50 rounded">
                                {{ category.name ?? 'Unknown Brand' }}<span v-if="index < product.categories.length - 1">,
                                </span>
                            </span>
    
    
    
    
    
                            <!-- Title -->
                            <div class="mt-3 text-slate-950 text-2xl font-medium leading-normal">
                                {{ product.name }}
    
                                <span v-if="product?.is_special" class="px-1 py-1 bg-red-500 text-white rounded-md text-xs">
                                (
                                    🔥 Special Offer
                                    )
                                </span>
                            </div>
    
                            <div v-if="product?.model">
                                <span class="text-muted text-xs">
                                    Model : {{ product?.model }}
                                </span>
                            </div>
    
                            <!-- Short Desciption -->
                            <div class="mt-2 text-slate-700 text-base font-normal leading-normal">
                                {{ product.short_description }}
                            </div>
    
                            <!-- Rating  review, sold and share -->
                                <div class="grid grid-cols-2 md:grid-cols-3 space-y-2 w-full mt-4 gap-2">
    
                                <div v-if="product?.driving_range" class="flex items-center gap-1 ml-0 md:ml-2"
                                >
                                    <div class="text-slate-950   font-bold leading-tight flex items-center">
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
    
                                        <!-- pole: from y=4 down to y=16 -->
                                        <line x1="5" y1="4" x2="5" y2="16" />
    
                                        <!-- flag top edge: starts exactly at pole top (5,4) -->
                                        <line x1="5"  y1="4"  x2="14" y2="8" />
    
                                        <!-- flag bottom edge -->
                                        <line x1="5"  y1="12" x2="14" y2="8" />
    
                                        <!-- oval base: center at (5,18), rx=3, ry=2 -->
                                        <ellipse cx="5" cy="18" rx="3" ry="2" fill="none"/>
                                        </svg>
    
                                        {{ product?.driving_range }}mi
    
    
                                        
                                    </div>
    
                                </div>
    
                                <div v-if="product?.battery_capacity" class="flex items-center gap-1"
                                   >
                                    
                                    <div class="flex items-center gap-1 text-slate-950 font-bold leading-tight">
                                        <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="0"
                                    version="1.2"
                                    baseProfile="tiny"
                                    >
                                    <path
                                        d="
                                        M9 16
                                            c-.552 0-1-.447-1-1
                                            v-4
                                            c0-.553.448-1 1-1
                                            s1 .447 1 1
                                            v4
                                            c0 .553-.448 1-1 1
                                        z
    
                                        M6 16
                                            c-.552 0-1-.447-1-1
                                            v-4
                                            c0-.553.448-1 1-1
                                            s1 .447 1 1
                                            v4
                                            c0 .553-.448 1-1 1
                                        z
    
                                        M15 16
                                            c-.552 0-1-.447-1-1
                                            v-4
                                            c0-.553.448-1 1-1
                                            s1 .447 1 1
                                            v4
                                            c0 .553-.448 1-1 1
                                        z
    
                                        M12 16
                                            c-.552 0-1-.447-1-1
                                            v-4
                                            c0-.553.448-1 1-1
                                            s1 .447 1 1
                                            v4
                                            c0 .553-.448 1-1 1
                                        z
    
                                        M19 10
                                            c0-1.654-1.346-3-3-3
                                            h-11
                                            c-1.654 0-3 1.346-3 3
                                            v6
                                            c0 1.654 1.346 3 3 3
                                            h11
                                            c1.654 0 3-1.346 3-3
                                            1.104 0 2-.896 2-2
                                            v-2
                                            c0-1.104-.896-2-2-2
                                        z
    
                                        m-2 6
                                            c0 .552-.449 1-1 1
                                            h-11
                                            c-.551 0-1-.448-1-1
                                            v-6
                                            c0-.552.449-1 1-1
                                            h11
                                            c.551 0 1 .448 1 1
                                            v6
                                        z
                                        "
                                    />
                                    </svg>
                                        {{ product?.battery_capacity }}kWh
                                    </div>
    
                                </div>
    
    
                                <div v-if="product?.year" class="flex items-center gap-1"
                                   >
                                    
                                    <div class="flex items-center text-slate-950 gap-2 font-bold leading-tight">
                                        <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"
                                        width="1em"
                                        height="1em"
                                        fill="currentColor"
                                        stroke="currentColor"
                                        stroke-width="0"
                                        >
                                        <path
                                            d="
                                            M0 464
                                                c0 26.5 21.5 48 48 48
                                                h352
                                                c26.5 0 48-21.5 48-48
                                                V192
                                                H0
                                                v272
                                                z
    
                                            M320 268
                                                c0-6.6 5.4-12 12-12
                                                h40
                                                c6.6 0 12 5.4 12 12
                                                v40
                                                c0 6.6-5.4 12-12 12
                                                h-40
                                                c-6.6 0-12-5.4-12-12
                                                v-40
                                                z
    
                                            m0 128
                                                c0-6.6 5.4-12 12-12
                                                h40
                                                c6.6 0 12 5.4 12 12
                                                v40
                                                c0 6.6-5.4 12-12 12
                                                h-40
                                                c-6.6 0-12-5.4-12-12
                                                v-40
                                                z
    
                                            M192 268
                                                c0-6.6 5.4-12 12-12
                                                h40
                                                c6.6 0 12 5.4 12 12
                                                v40
                                                c0 6.6-5.4 12-12 12
                                                h-40
                                                c-6.6 0-12-5.4-12-12
                                                v-40
                                                z
    
                                            m0 128
                                                c0-6.6 5.4-12 12-12
                                                h40
                                                c6.6 0 12 5.4 12 12
                                                v40
                                                c0 6.6-5.4 12-12 12
                                                h-40
                                                c-6.6 0-12-5.4-12-12
                                                v-40
                                                z
    
                                            M64 268
                                                c0-6.6 5.4-12 12-12
                                                h40
                                                c6.6 0 12 5.4 12 12
                                                v40
                                                c0 6.6-5.4 12-12 12
                                                H76
                                                c-6.6 0-12-5.4-12-12
                                                v-40
                                                z
    
                                            m0 128
                                                c0-6.6 5.4-12 12-12
                                                h40
                                                c6.6 0 12 5.4 12 12
                                                v40
                                                c0 6.6-5.4 12-12 12
                                                H76
                                                c-6.6 0-12-5.4-12-12
                                                v-40
                                                z
    
                                            M400 64
                                                h-48
                                                V16
                                                c0-8.8-7.2-16-16-16
                                                h-32
                                                c-8.8 0-16 7.2-16 16
                                                v48
                                                H160
                                                V16
                                                c0-8.8-7.2-16-16-16
                                                h-32
                                                c-8.8 0-16 7.2-16 16
                                                v48
                                                H48
                                                C21.5 64 0 85.5 0 112
                                                v48
                                                h448
                                                v-48
                                                c0-26.5-21.5-48-48-48
                                                z
                                            "
                                        />
                                        </svg>
    
                                        {{ product?.year }}
                                    </div>
    
                                </div>
    
                                <div v-if="product?.peak_power" class="flex items-center gap-1"
                                   >
                                   <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="0"
                                    >
                                    <path
                                        fill="none"
                                        d="M0 0h24v24H0z"
                                    />
                                    <path
                                        d="
                                        M11 21
                                            h-1
                                            l1-7
                                            H7.5
                                            c-.88 0-.33-.75-.31-.78
                                            C8.48 10.94 10.42 7.54 13.01 3
                                            h1
                                            l-1 7
                                            h3.51
                                            c.4 0 .62.19.4.66
                                            C12.97 17.55 11 21 11 21
                                        z
                                        "
                                    />
                                    </svg>
    
                                    <div  class="text-slate-950  font-bold leading-tight">
                                        {{ product?.peak_power }} kW
                                    </div>
    
                                </div>
                               
    
                                <div class="flex items-center gap-2"
                                 v-if="product?.acceleration_time"
                                  >
                                    <!-- <StarIcon class="w-4 h-4 text-yellow-400" /> -->
    
                                    <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 16 16"
                                    width="20" height="20"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="0"
                                    >
                                        <path
                                            d="
                                            M8 2
                                            a.5.5 0 0 1 .5.5
                                            V4
                                            a.5.5 0 0 1-1 0
                                            V2.5
                                            A.5.5 0 0 1 8 2
    
                                            M3.732 3.732
                                            a.5.5 0 0 1 .707 0
                                            l.915.914
                                            a.5.5 0 1 1-.708.708
                                            l-.914-.915
                                            a.5.5 0 0 1 0-.707
    
                                            M2 8
                                            a.5.5 0 0 1 .5-.5
                                            h1.586
                                            a.5.5 0 0 1 0 1
                                            H2.5
                                            A.5.5 0 0 1 2 8
    
                                            m9.5 0
                                            a.5.5 0 0 1 .5-.5
                                            h1.5
                                            a.5.5 0 0 1 0 1
                                            H12
                                            a.5.5 0 0 1-.5-.5
    
                                            m.754-4.246
                                            a.39.39 0 0 0-.527-.02
                                            L7.547 7.31
                                            A.91.91 0 1 0 8.85 8.569
                                            l3.434-4.297
                                            a.39.39 0 0 0-.029-.518
                                            z
                                            "
                                        />
    
                                        <!-- silhouette / outline -->
                                        <path
                                            fill-rule="evenodd"
                                            d="
                                            M6.664 15.889
                                            A8 8 0 1 1 9.336.11
                                            a8 8 0 0 1-2.672 15.78
                                            z
    
                                            m-4.665-4.283
                                            A11.95 11.95 0 0 1 8 10
                                            c2.186 0 4.236.585 6.001 1.606
                                            a7 7 0 1 0-12.002 0
                                            "
                                        />
                                    </svg>
    
                                    <!-- rating -->
                                    <div class="text-slate-950 font-bold leading-tight">
                                        {{ product?.acceleration_time }} s
                                    </div>
                                    
                                    <!-- total sold -->
                                    
                                    <!-- Stock Out -->
                                    <!-- <div v-else class="text-right text-red-500 text-xs font-normal leading-tight">
                                        {{ $t('Stock Out') }}
                                    </div> -->
                                </div>
    
    
                                <div 
                                    class="flex  font-bold leading-tight flex items-center  gap-2">
                                    <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512"
                                    width="20" height="20"
                                    fill="currentColor"
                                    stroke="currentColor"
                                    stroke-width="0"
                                    >
                                    <path
                                        d="
                                        M288 32
                                            c-80.8 0-145.5 36.8-192.6 80.6
                                            C48.6 156 17.3 208 2.5 243.7
                                            c-3.3 7.9-3.3 16.7 0 24.6
                                            C17.3 304 48.6 356 95.4 399.4
                                            C142.5 443.2 207.2 480 288 480
                                            s145.5-36.8 192.6-80.6
                                            c46.8-43.5 78.1-95.4 93-131.1
                                            c3.3-7.9 3.3-16.7 0-24.6
                                            c-14.9-35.7-46.2-87.7-93-131.1
                                            C433.5 68.8 368.8 32 288 32
                                        z
    
                                        M144 256
                                            a144 144 0 1 1 288 0
                                            a144 144 0 1 1 -288 0
                                        z
    
                                        m144-64
                                            c0 35.3-28.7 64-64 64
                                            c-7.1 0-13.9-1.2-20.3-3.3
                                            c-5.5-1.8-11.9 1.6-11.7 7.4
                                            c.3 6.9 1.3 13.8 3.2 20.7
                                            c13.7 51.2 66.4 81.6 117.6 67.9
                                            s81.6-66.4 67.9-117.6
                                            c-11.1-41.5-47.8-69.4-88.6-71.1
                                            c-5.8-.2-9.2 6.1-7.4 11.7
                                            c2.1 6.4 3.3 13.2 3.3 20.3
                                        z
                                        "
                                    />
                                    </svg>
    
                                    {{ product?.visit_count }} 
                                </div>
                            </div>
                            
                      
                            <div class="py-5 flex flex-wrap justify-start items-center mt-4 gap-4 border-b border-slate-200">
                                <!-- rating -->
                                <div class="flex items-center gap-2">
                                    <div class="flex">
                                        <StarIcon class="w-6 h-6 text-amber-500" />
                                        <StarIcon v-for="i in 4" :key="i" class="w-6 h-6  2xl:block hidden"
                                            :class="i < product.rating ? 'text-amber-500' : 'text-gray-300'" />
                                    </div>
                                
                                </div>
    
                                <div class="w-[1px] h-4 bg-slate-200"></div>
    
                                <!-- Sold -->
                                <div class="text-slate-800 text-base font-normal leading-normal">
                                    {{ product.visit_count }}
                                    {{ product.visit_count === 1 ? $t('View') : $t('Views') }}
                                </div>
    
                                <div class="w-[1px] h-4 bg-slate-200"></div>
    
                        
                                <div class="w-[1px] h-4 bg-slate-200"></div>
    
                                <!-- Heart Icon -->
                                <button class="border-none" @click="favoriteAddOrRemove">
                                    <HeartIcon v-if="!product.is_favorite" class="w-6 h-6 text-slate-600" />
                                    <HeartIconFill v-else class="w-6 h-6 text-red-500" />
                                </button>
                            </div>
    
                            <!-- Price part -->
                            <div class="flex items-center gap-3 py-4 border-b border-slate-200 flex-wrap">
                                <!-- discount Price -->
                                <div class="text-primary text-3xl font-bold leading-9">
                                    {{ masterStore.showCurrency(product.discount_price > 0 ? product.discount_price :
                                    product.price) }}
                                </div>
    
                                <!-- Price -->
                                <div v-if="product.discount_price > 0"
                                    class="text-slate-400 text-2xl font-normal line-through leading-loose">
                                    {{ masterStore.showCurrency(product.price) }}
                                </div>
    
                                <!-- discount -->
                                <div v-if="product.discount_percentage"
                                    class="px-2 py-1 bg-red-500 rounded-2xl text-white text-base font-medium">
                                    {{ product.discount_percentage }}% {{ $t('OFF') }}
                                </div>
                            </div>
    
                            <!-- Size -->
                            <div v-if="product.sizes?.length > 0" class="flex items-center gap-3 py-4">
                                <div class="w-[40px] md:w-[88px] text-slate-600 text-base font-normal leading-normal">
                                    {{ $t('Size') }}
                                </div>
    
                                <div class="flex flex-wrap items-center gap-3">
                                    <div v-for="size in product.sizes" :key="size.id" class="relative">
                                        <input type="radio" name="size" :id="'size-' + size.name" class="peer hidden"
                                            :value="size.name" v-model="formData.size">
                                        <label :for="'size-' + size.name"
                                            class="min-w-11 w-auto h-9 flex justify-center items-center border-2 border-slate-200 rounded-md cursor-pointer peer-checked:border-primary peer-checked:bg-primary-100 px-2">
                                            {{ size.name }}
                                        </label>
                                    </div>
                                    <div v-if="!product.sizes" class="text-slate-500 text-base font-normal">
                                        {{ $t('N/A') }}
                                    </div>
    
                                </div>
                            </div>
    
                            <!-- Color -->
                            <div v-if="product.colors?.length > 0" class="flex items-center gap-3 py-4">
                                <div class="w-[40px] md:w-[88px] text-slate-600 text-base font-normal leading-normal">
                                    {{ $t('Color') }}
                                </div>
    
                                <div class="flex flex-wrap items-center gap-3">
                                    <div v-for="color in product.colors" :key="color.id" class="relative">
                                        <input type="radio" name="color" :id="'color-' + color.name" class="peer hidden"
                                            :value="color.name" v-model="formData.color" />
                                        <label :for="'color-' + color.name"
                                            class="px-2 py-1 flex justify-center items-center border-2 border-slate-200 rounded-md cursor-pointer peer-checked:border-primary peer-checked:bg-primary-100">
                                            {{ color.name }}
                                        </label>
                                    </div>
    
                                    <div v-if="!product.colors" class="text-slate-500 text-base font-normal">
                                        {{ $t('N/A') }}
                                    </div>
                                </div>
    
                            </div>
    
                            <div class="flex flex-wrap gap-4">
                                <!-- Quantity Increase Or Decrease -->
                                <div v-if="cartProduct"
                                    class="p-2 rounded-[10px] border border-slate-100 inline-flex gap-4">
                                    <button class="bg-slate-200 p-2 rounded" @click="decrementQty">
                                        <MinusIcon class="w-6 h-6 text-slate-800" />
                                    </button>
    
                                    <div
                                        class="w-6 flex items-center justify-center text-center text-slate-950 text-base font-medium leading-normal">
                                        {{ cartProduct.quantity }}
                                    </div>
    
                                    <button class="bg-slate-100 p-2 rounded" @click="incrementQty">
                                        <PlusIcon class="w-6 h-6 text-slate-800" />
                                    </button>
                                </div>
                                <!-- Add to Cart -->
                                <button v-if="!cartProduct"
                                    class="grow max-w-56 justify-center items-center text-primary flex gap-2  px-6 py-4 rounded-[10px] border border-primary"
                                    @click="addToCart">
                                    <img :src="'/assets/icons/bag-active.svg'" loading="lazy" class="w-5 h-5">
                                    <div class="text-base font-medium leading-normal">
                                        {{ $t('Add to Cart') }}
                                    </div>
                                </button>
    
                            </div>
    
                        </div>
                    </div>
    
                    <div class="block xl:hidden w-full pt-6 border-slate-200">
                        <ProductDetailsRightSide :product="product" :popularProducts="popularProducts" />
                    </div>
    
                    <div class="flex items-center gap-8 flex-wrap border-b mt-3 mb-4 xl:my-6">
    
                        <button class="py-3 transition text-base font-medium leading-normal border-b"
                            :class="aboutProduct ? 'text-primary border-primary' : 'text-slate-600 border-transparent'"
                            @click="aboutProduct = true; review = false">
                            {{ $t('About Product') }}
                        </button>
    
                        <button class="py-3 transition text-base font-medium leading-normal border-b"
                            :class="review ? 'text-primary border-primary' : 'text-slate-600 border-transparent'"
                            @click="showReview()">
                            {{ $t('Reviews') }}
                        </button>
                    </div>
                    <!-- About Product -->
                    <div v-if="aboutProduct" class="">
                        <div v-html="product.description"></div>
    
                        <!-- PDF Download -->
                        <div  class="mt-6" v-if="product?.pdf_file">
                            <h3 class="text-lg font-medium text-slate-800 mb-3">Additional Document</h3>
                            <a
                                @click.stop="openPdf(product?.pdf_file)"
                                target="_blank"
    
                                class="inline-flex cursor-pointer items-center gap-2 px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Read PDF
                            </a>
                        </div>
                    </div>
    
                    
    
                    <!-- Reviews -->
                    <div v-if="review" class="">
                        <div class="text-slate-950 text-lg lg:text-2xl font-medium leading-loose mb-4">
                            {{ $t('Rating and Review') }}
                        </div>
    
                        <!-- Review Rating percentage -->
                        <div class="max-w-2xl">
                            <ReviewRatings :reviewRatings="avarageRatings.percentages"
                                :avarageRating="avarageRatings?.rating" :totalReview="avarageRatings.total_review" />
                        </div>
    
                        <!-- Reviews -->
                        <div class="border-t border-slate-200 mt-6">
                            <div class="mt-4 lg:mt-6 text-slate-950 text-lg lg:text-2xl font-medium leading-loose">
                                {{ $t('Reviews') }}
                            </div>
    
                            <div class="space-y-6 mt-6">
                                <Review v-for="review in reviews" :key="review.id" :review="review" />
                            </div>
    
                            <!-- paginations -->
                            <div class="flex justify-between items-center w-full mt-8  gap-4 flex-wrap">
                                <div class="text-slate-800 text-base font-normal leading-normal">
                                    {{ $t('Showing') }} {{ perPage * (currentPage - 1) + 1 }} {{ $t('to') }} {{ perPage *
                                        (currentPage - 1) +
                                    reviews.length }} {{ $t('of') }} {{ totalReviews }} {{ $t('results') }}
                                </div>
                                <div>
                                    <vue-awesome-paginate :total-items="totalReviews" :items-per-page="perPage"
                                        type="button" :max-pages-shown="3" v-model="currentPage"
                                        :hide-prev-next-when-ends="true" @click="onClickHandler" />
                                </div>
                            </div>
    
                        </div>
    
                    </div>
    
                </div>
    
                <!-- Right side -->
                <div
                    class="hidden xl:block col-span-1 w-full pt-6 h-full xl:pt-16 xl:pl-8 xl:border-l border-slate-200 xl:pb-6">
                    <ProductDetailsRightSide :product="product" :popularProducts="popularProducts" />
                </div>
    
            </div>
    
            <!-- Similar Products -->
            <div class="mt-4 xl:mt-6 text-slate-800 text-lg md:text-2xl lg:text-3xl font-bold leading-9">
                {{ $t('Similar Products') }}
            </div>
    
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-5  gap-3 sm:gap-6 items-start my-6">
                <div v-for="product in relatedProducts" :key="product.id">
                    <ProductCard :product="product" />
                </div>
        </div>
        </div>


    </div>
</template>

<script setup>
import { onMounted, ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router';
import { useMaster } from '../stores/MasterStore';
import ProductDetailsRightSide from '../components/ProductDetailsRightSide.vue';
import ToastSuccessMessage from '../components/ToastSuccessMessage.vue';

import { HomeIcon, ShareIcon, HeartIcon, MinusIcon, PlusIcon } from '@heroicons/vue/24/outline';
import { StarIcon, HeartIcon as HeartIconFill } from '@heroicons/vue/24/solid';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { FreeMode, Navigation, Thumbs } from 'swiper/modules';

import ReviewRatings from '../components/ReviewRatings.vue';
import Review from '../components/Review.vue';
import ProductCard from '../components/ProductCard.vue';
import { useBaskerStore } from '../stores/BasketStore';
import { useAuth } from '../stores/AuthStore';

import VueCountdown from '@chenfengyuan/vue-countdown';
const time = ref(7 * 60 * 60 * 1000);
// const time = ref(30 * 24 * 60 * 60 * 1000);
// const end = ref(new Date().getTime() + time.value);

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';

import { useToast } from 'vue-toastification';
const toast = useToast();

const thumbsSwiper = ref(null);

const modules = [FreeMode, Navigation, Thumbs];

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper;
};

const route = useRoute();
const router = useRouter();
const masterStore = useMaster();
const basketStore = useBaskerStore();
const authStore = useAuth();

const formData = ref({
    product_id: route.params.id,
    size: null,
    color: null,
    unit: null,
});

const product = ref({});
const relatedProducts = ref([]);
const popularProducts = ref([]);

const aboutProduct = ref(true);
const review = ref(false);

const cartProduct = ref(null);
const loading = ref(true)   




onMounted(() => {
    fetchProductDetails();
    window.scrollTo(0, 0);
    findProductInCart(route.params.id);
});

const buyNow = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    basketStore.buyNowProduct = product.value;
    basketStore.buyNowProduct.size = formData.value.size;
    basketStore.buyNowProduct.color = formData.value.color;
    router.push({ name: 'buynow' })
};



const openPdf = (pdfFile) => {

    
    const pdfUrl =pdfFile; // Dynamically fetch the PDF URL from product data
    console.log('pdfUrl', pdfUrl);
    if (pdfUrl) {
        window.open(pdfUrl, '_blank'); // Open PDF in a new tab
    } else {
        toast.error('PDF file not available for this product.', {
            position: "bottom-left",
        });
    }
};

watch(route, () => {
    fetchProductDetails();
    aboutProduct.value = true;
    review.value = false;
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
    formData.value.product_id = route.params.id;
    findProductInCart(route.params.id);
});

const findProductInCart = (productId) => {
    let foundProduct = null;
    basketStore.products.forEach((item) => {
        item.products.find((product) => {
            if (product.id == productId) {
                return foundProduct = product;
            }
        })
    });
    cartProduct.value = foundProduct;
    if (foundProduct) {
        formData.value.size = foundProduct.size;
        formData.value.color = foundProduct.color;
        formData.value.unit = foundProduct.unit;
    }
}

const addToCart = () => {
    basketStore.addToCart(formData.value, product.value)
    setTimeout(() => {
        findProductInCart(route.params.id);
    }, 500);
}

const decrementQty = () => {
    basketStore.decrementQuantity(product.value);
    setTimeout(() => {
        findProductInCart(route.params.id);
    }, 500);
}

const incrementQty = () => {
    basketStore.incrementQuantity(product.value);
    setTimeout(() => {
        findProductInCart(route.params.id);
    }, 500);
}

const favoriteAddOrRemove = () => {
    if (authStore.token === null) {
        return authStore.loginModal = true;
    }
    axios.post('/favorite-add-or-remove', {
        product_id: product.value.id
    }, {
        headers: {
            Authorization: authStore.token
        }
    }).then(() => {
        product.value.is_favorite = !product.value.is_favorite
        if (product.value.is_favorite === false) {
            const content = {
                component: ToastSuccessMessage,
                props: {
                    title: 'Product removed from favorite',
                    message: 'Product removed from favorite successfully',
                },
            };
            toast(content, {
                type: "default",
                hideProgressBar: true,
                icon: false,
                position: "top-right",
                toastClassName: "vue-toastification-alert",
                timeout: 3000
            });
        } else {
            const content = {
                component: ToastSuccessMessage,
                props: {
                    title: 'Product added to favorite',
                    message: 'Product added to favorite successfully',
                },
            };
            toast(content, {
                type: "default",
                hideProgressBar: true,
                icon: false,
                position: "top-right",
                toastClassName: "vue-toastification-alert",
                timeout: 3000
            });
        }
        authStore.fetchFavoriteProducts();
    }).catch((error) => {
        console.log(error);
    });
}

const showReview = () => {
    aboutProduct.value = false;
    review.value = true;
    fetchReviews();
}

const fetchProductDetails = async () => {
    loading.value = true;
    axios.get('/product-details', {
        params: { product_id: route.params.id },
        headers: {
            Authorization: authStore.token,
        }
    }).then((response) => {
        product.value = response.data.data.product;
        relatedProducts.value = response.data.data.related_products;
        popularProducts.value = response.data.data.popular_products;

        console.log('product', product.value);


        if (product.value.colors.length > 0) {
            formData.value.color = product.value.colors[0].name;
        } else {
            formData.value.color = null
        }
        if (product.value.sizes.length > 0) {
            formData.value.size = product.value.sizes[0].name;
        } else {
            formData.value.size = null
        }
        findProductInCart(route.params.id);
    })
    .catch((error) => {
        console.log(error);
    }).finally(() => {
        loading.value = false;
    });
};

const avarageRatings = ref({});

const totalReviews = ref(0);
const reviews = ref([]);

const currentPage = ref(1);
const perPage = ref(6);

const onClickHandler = (page) => {
    currentPage.value = page;
    fetchReviews();
};

const fetchReviews = async () => {
    axios.get('/reviews', { params: { product_id: route.params.id, page: currentPage.value, per_page: perPage.value } }).then((response) => {
        totalReviews.value = response.data.data.total;
        reviews.value = response.data.data.reviews;
        avarageRatings.value = response.data.data.average_rating_percentage;
    })
};

</script>

<style>
.product-details-slider .swiper-slide {
    height: auto !important;
}

.product-details-thumbnail .swiper-slide {
    @apply h-20 md:h-[120px] lg:h-[100px];
}

.product-details-thumbnail .swiper-button-prev,
.product-details-thumbnail .swiper-button-next {
    @apply bg-white w-6 h-6 rounded-full shadow border border-slate-200 text-slate-600 -translate-y-1/2 mt-0;
}

.product-details-thumbnail .swiper-button-prev::after,
.product-details-thumbnail .swiper-button-next::after {
    @apply text-base;
}

.product-details-thumbnail .swiper-button-next {
    right: 0px;
}

.product-details-thumbnail .swiper-button-prev {
    left: 0px;
}

.product-details-thumbnail .swiper-slide {
    @apply border border-slate-100 rounded-lg transition overflow-hidden;
}

.product-details-thumbnail .swiper-slide-thumb-active {
    @apply border border-primary;
}
</style>
