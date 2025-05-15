/* resources/js/app.js */
import './bootstrap'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPersist from 'pinia-plugin-persistedstate'
import piniaAxiosAuth from '@/stores/piniaAxiosAuth'   // <<— plugin that syncs token → axios

import axios from 'axios'

import App    from './App.vue'
import router from './router'

/* ---------- 3rd-party UI libs ---------- */
import VueAwesomePaginate from 'vue-awesome-paginate'
import 'vue-awesome-paginate/dist/style.css'

import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

import VueSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

/* ---------- localization helper ---------- */
import localization from './localization'

/* ---------- axios base config ---------- */
axios.defaults.baseURL = '/api'        // change if your API lives elsewhere

/* ---------- pinia ---------- */
const pinia = createPinia()
pinia.use(piniaAxiosAuth)              // MUST come before persistence
pinia.use(piniaPersist)

const app = createApp(App)

/* ---------- global components & plugins ---------- */
app.component('v-select', VueSelect)

localization.fetchLocalizationData()
app.use(localization.i18n)

app.use(pinia)
app.use(router)
app.use(VueAwesomePaginate)
app.use(Toast)

/* ---------- global 401/419 interceptor ---------- */
import { useAuth } from '@/stores/authStore'
const auth = useAuth()                 // must be after pinia install

axios.interceptors.response.use(
  (r) => r,
  (err) => {
    if ([401, 419].includes(err.response?.status)) {
      auth.logout()
    //   auth.loginModal = true
      // next(false)                              
      window.location.href = '/' 
    }
    return Promise.reject(err)
  },
)

app.mount('#app')
