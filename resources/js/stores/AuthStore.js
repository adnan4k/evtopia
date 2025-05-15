import { defineStore } from "pinia";
import axios from "axios";
import { useBaskerStore } from "./BasketStore";

export const useAuth = defineStore("authStore", {
    state: () => ({
        user: null,
        addresses: [],
        token: null,
        favoriteProducts: 0,
        loginModal: false,
        registerModal: false,
        showAddressModal: false,
        showChangeAddressModal: false,
        orderCancel: false,
        favoriteRemove: false,
    }),

    getters: {
        getAddressById: (state) => (id) => {
            return state.addresses.find((address) => address.id == id);
        },
    },

    actions: {
        setToken(raw) {
            if (raw) {
              this.token = raw.startsWith('Bearer ') ? raw : `Bearer ${raw}`
              axios.defaults.headers.common.Authorization = this.token
            } else {
              delete axios.defaults.headers.common.Authorization
              this.token = null
            }
          },
        setUser(user) {
            this.user = user;
        },

        showLoginModal() {
            this.loginModal = true;
        },

        hideLoginModal() {
            this.loginModal = false;
        },

        fetchAddresses() {
            axios.get("/addresses", {
                headers: {
                    Authorization: this.token,
                },
            }).then((response) => {
                this.addresses = response.data.data.addresses;
                const basketStore = useBaskerStore();
                this.addresses.forEach((address) => {
                    if (address.is_default) {
                        basketStore.address = address;
                        return true;
                    }else{
                        basketStore.address = this.addresses[0];
                    }
                });
            })
            .catch((error) => {
                console.log(error);
                // logout the user if the token is invalid
                    this.user = null;
                    this.addresses = [];
                    this.token = null;
            });
        },
        fetchFavoriteProducts() {
            if (this.token) {
                axios.get("/favorite-products", {
                    headers: {
                        Authorization: this.token,
                    },
                }).then((response) => {
                    this.favoriteProducts = response.data.data.products?.length ?? 0;
                });
            } else {
                this.favoriteProducts = 0;
            }
        },


        logout() {

            // add user id to the logout request
            const id = this.user?.id;
            if (!id) {
                return;
            }
           axios.post("/logout-user" + `/${id}` , {
                headers: {
                    Authorization: this.token,
                },
            }).then((response) => {
                console.log(response);
                this.user = null;
                this.addresses = [];
                this.token = null;
            })
            .catch((error) => {
                console.log(error);

                this.user = null;
                this.addresses = [];
                this.token = null;
            });
        },
    },

    persist: true,
});
