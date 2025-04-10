<template>
    <div>
        <!-- login modal-->
        <TransitionRoot as="template" :show="AuthStore.loginModal">
            <Dialog as="div" class="relative z-10" @close="AuthStore.hideLoginModal()">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity" />
                </TransitionChild>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <TransitionChild as="template" enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <DialogPanel
                                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all my-8 md:my-0 w-full sm:max-w-lg md:max-w-xl">
                                <div class="bg-white p-5 sm:p-8 relative">
                                    <!-- close button -->
                                    <div class="w-9 h-9 bg-slate-100 rounded-[32px] absolute top-4 right-4 flex justify-center items-center cursor-pointer"
                                        @click="AuthStore.hideLoginModal()">
                                        <XMarkIcon class="w-6 h-6 text-slate-600" />
                                    </div>
                                    <!-- end close button -->

                                    <div class="text-slate-950 text-lg sm:text-2xl font-medium leading-loose">{{ $t('Welcome') }}!
                                    </div>

                                    <div class="text-slate-950 text-lg font-normal leading-7 tracking-tight mt-3">
                                        {{ $t('Please Login to continue') }}
                                    </div>

                                    <!-- Phone Number -->
                                    <div class="mt-8">
                                        <label
                                            class="text-slate-700 text-base font-normal leading-normal mb-2 block">
                                            {{ $t('Email / Phone Number') }}
                                        </label>

                                        <input type="text" v-model="loginFormData.phone"
                                            :placeholder="$t('Enter email or phone number')"
                                            class="text-base font-normal w-full p-3 placeholder:text-slate-400 rounded-lg border  focus:border-primary outline-none"
                                            :class="errors && errors?.phone ? 'border-red-500' : 'border-slate-200'">
                                        <span v-if="errors && errors?.phone" class="text-red-500 text-sm">{{
                                            errors?.phone[0] }}</span>
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <label
                                            class="text-slate-700 text-base font-normal leading-normal mb-2 block">{{ $t('Password') }}</label>

                                        <div class="relative">
                                            <input :type="showLoginPassword ? 'text' : 'password'"
                                                v-model="loginFormData.password" :placeholder="$t('Enter Password')"
                                                class="text-base font-normal w-full p-3 placeholder:text-slate-400 rounded-lg border focus:border-primary outline-none"
                                                :class="errors && errors?.password ? 'border-red-500' : 'border-slate-200'">
                                            <button @click="showLoginPassword = !showLoginPassword">
                                                <EyeIcon v-if="showLoginPassword"
                                                    class="w-6 h-6 text-slate-700 absolute right-4 top-1/2 -translate-y-1/2" />
                                                <EyeSlashIcon v-else
                                                    class="w-6 h-6 text-slate-700 absolute right-4 top-1/2 -translate-y-1/2" />
                                            </button>
                                        </div>
                                        <span v-if="errors && errors?.password" class="text-red-500 text-sm">{{
                                            errors?.password[0] }}</span>
                                    </div>

                                    <!-- Forgot Password -->
                                    <div class="mt-4 text-right">
                                        <button class="text-right text-slate-700 text-base font-normal leading-normal"
                                            @click="showForgetPasswordDilog()">
                                            {{ $t('Forgot Password') }}?
                                        </button>
                                    </div>

                                    <!-- login button -->
                                    <button
                                        class="px-6 py-4 bg-primary mt-8 rounded-[10px] text-white text-base font-medium w-full"
                                        @click="loginFormSubmit">
                                        {{ $t('Log in') }}
                                    </button>

                                    <div class="px-4 py-2 mt-6 flex items-center justify-center gap-2">
                                        <div class="text-slate-900 text-base font-normal">
                                            {{ $t('Don’t have an account') }}?
                                        </div>
                                        <button class="text-primary text-base font-normal" @click="showRegisterDilog">
                                            {{ $t('Sign Up') }}
                                        </button>
                                    </div>

                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- forget password dialog -->
        <ForgetPasswordDialogModal :forgetPasswordDilog="forgetPasswordDilog" :countries="countries" @closeForget="forgetPasswordDilog = false" />

        <!-- registration dialog -->
        <RegistrationDialogModal :registerDilog="registerDilog" :countries="countries" @hideRegisterDilog="registerDilog = false" @showLogin="showLoginDilog" />

    </div>
</template>

<script setup>
import { nextTick, onMounted, ref, watch } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { EyeIcon, EyeSlashIcon } from '@heroicons/vue/24/solid'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import RegistrationDialogModal from './RegistrationDialogModal.vue'
import ForgetPasswordDialogModal from './ForgetPasswordDialogModal.vue'
import ToastSuccessMessage from './ToastSuccessMessage.vue'

import { useToast } from 'vue-toastification'
import { useAuth } from '../stores/AuthStore'
import { useBaskerStore } from '../stores/BasketStore'
import { useServiceStore } from '../stores/ServiceStore'
import { useMaster } from '../stores/MasterStore'

import axios from 'axios'
import { useRouter } from 'vue-router'
const router = useRouter();

const toast = useToast();
const baskerStore = useBaskerStore();
const serviceStore = useServiceStore();
const master = useMaster();

const AuthStore = useAuth();

const showLoginPassword = ref(false);

const forgetPasswordDilog = ref(false);
const registerDilog = ref(false);

const loginFormData = ref({
    phone: '',
    password: ''
});

onMounted(() => {
    // if (master.app_environment == 'local') {
    //     loginFormData.value.phone = '';
    //     loginFormData.value.password = '';
    // }

    fetchCountries();
});

const showForgetPasswordDilog = () => {
    forgetPasswordDilog.value = true
    AuthStore.hideLoginModal();
}

const errors = ref({});

const content = {
    component: ToastSuccessMessage,
    props: {
        title: 'Login Successful',
        message: 'You have successfully logged in.',
    },
};

const countries = ref([]);

const fetchCountries = () => {
    axios.get('/countries').then((response) => {
        countries.value = response.data.data.countries
    })
}

const loginFormSubmit = () => {
        axios.post('/login', loginFormData.value).then((response) => {
            AuthStore.setToken(response.data.data.access.token);
            AuthStore.setUser(response.data.data.user);
            AuthStore.hideLoginModal();
            baskerStore.fetchCart();
            serviceStore.fetchCart();
            toast(content, {
                type: "default",
                hideProgressBar: true,
                icon: false,
                position: "top-right",
                toastClassName: "vue-toastification-alert",
                timeout: 3000
            });
        }).catch((error) => {
            toast.error(error.response.data.message, {
                position: "bottom-left",
            });
            errors.value = error.response.data.errors
        })
}

const showRegisterDilog = () => {
    AuthStore.hideLoginModal();
    registerDilog.value = true
}

const showLoginDilog = () => {
    registerDilog.value = false
    AuthStore.showLoginModal();
}

</script>
