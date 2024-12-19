import axios from "axios";
import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import AddToCartServiceDialog from "../components/AddToCartServiceDialog.vue";
import RemoveCartPopupDialog from "../components/RemoveCartPopupDialog.vue";

import { useAuth } from "./AuthStore";

const toast = useToast();

export const useServiceStore = defineStore("serviceStore", {
    state: () => ({
        total: 0,
        services: [],
        checkoutServices: [],
        selectedShopIds: [],
        total_amount: 0,
        delivery_charge: 0,
        coupon_discount: 0,
        payable_amount: 0,
        coupon_code: "",
        showOrderConfirmModal: false,
        orderPaymentCancelModal: false,
        address: null,
        buyNowProduct: null,
        others:null,
        serviceTotalAmount:0
    }),

    getters: {
        totalAmount: (state) => {
            let total = 0;
            state.services.forEach((s) => {
                    let price =
                        s.service.discounted_price > 0
                            ? s.service.discounted_price
                            : s.service.price;
                    total += price * s.quantity;
            });
            return total.toFixed(2);
        },

        totalCheckoutAmount: (state) => {
            let total = 0;
            state.checkoutServices.forEach((item) => {
                item.services.forEach((service) => {
                    let price =
                        service.discounted_price > 0
                            ? service.discounted_price
                            : service.price;
                    total += price * service.quantity;
                });
            });
            return total.toFixed(2);
        },

        checkoutTotalItems: (state) => {
            let total = 0;
            state.checkoutServices.forEach((item) => {
                total += item.services.length;
            });
            return total;
        },
    },

    actions: {
        addToCart(data, service) {

            if (data.service_id) {
                const content = {
                    component: AddToCartServiceDialog,
                    props: {
                        service: service,
                    },
                };
                const authStore = useAuth();
                axios
                    .post("/service-cart/store", data, {
                        headers: {
                            Authorization: authStore.token,
                        },
                    })
                    .then((response) => {
                        this.total = response.data.data.total;
                        this.services = response.data.data.cart_items;
                        this.total_amount = response.data.data.checkout.total_amount;
                        this.delivery_charge = response.data.data.checkout.delivery_charge;
                        this.coupon_discount =response.data.data.checkout.coupon_discount;
                        this.payable_amount = response.data.data.checkout.payable_amount;
                       
                        this.serviceTotalAmount = response.data.data.checkout.total_amount;
                        toast(content, {
                            type: "default",
                            hideProgressBar: true,
                            icon: false,
                            position: "bottom-left",
                            toastClassName: "vue-toastification-alert",
                            timeout: 3000,
                        });
                    })
                    .catch((error) => {
                        if (error.response.status == 401) {
                            toast.error("Please login first!", {
                                position: "bottom-left",
                            });
                            const authStore = useAuth();
                            authStore.showLoginModal();
                        } else {
                            toast.error(error.response.data.message, {
                                position: "bottom-left",
                            });
                        }
                    });
            }
        },

        fetchCart() {
            const authStore = useAuth();
            if (authStore.token) {
                axios.get("/service-carts", {
                    headers: {
                        Authorization: authStore.token,
                    },
                })
                .then((response) => {

                    this.total = response.data.data.total;
                    this.services = response.data.data.cart_items;
                    this.others = response.data.data.checkout;

                    this.total_amount = response.data.data.checkout.total_amount;
                    this.delivery_charge = response.data.data.checkout.delivery_charge;
                    this.coupon_discount =response.data.data.checkout.coupon_discount;
                    this.payable_amount = response.data.data.checkout.payable_amount;

                   

                    this.serviceTotalAmount = response.data.data.checkout.total_amount;

                }).catch((error) => {
                    console.log(error);
                })
            } else {
                this.total = 0;
                this.services = [];
                this.checkoutServices = [];
                this.selectedShopIds = [];
                this.total_amount = 0;
                this.delivery_charge = 0;
                this.coupon_discount = 0;
                this.payable_amount = 0;
                this.coupon_code = "";
                this.address = null;
                authStore.user = null;
                authStore.addresses = [];
                authStore.token = null;
            }
        },

        decrementQuantity(service) {
            const authStore = useAuth();
            if (service) {
                const content = {
                    component: RemoveCartPopupDialog,
                    props: {
                        service: service,
                    },
                };
                axios
                    .post(
                        "/cart/decrement",
                        { service_id: service.id },
                        {
                            headers: {
                                Authorization: authStore.token,
                            },
                        }
                    )
                    .then((response) => {
                        this.total = response.data.data.total;
                        this.services = response.data.data.cart_items;

                        
                        this.fetchCheckoutServices();

                        if (
                            response.data.message == "service removed from cart"
                        ) {
                          
                            // const exists = shopIds.some((id) => selectedShopIds.includes(id));

                            if (this.services.length === 0) {
                                this.selectedShopIds = [];
                                this.checkoutServices = [];
                                this.total_amount = 0;
                                this.delivery_charge = 0;
                                this.coupon_discount = 0;
                                this.payable_amount = 0;
                            }

                            toast(content, {
                                type: "default",
                                hideProgressBar: true,
                                icon: false,
                                position: "bottom-left",
                                toastClassName: "vue-toastification-alert",
                                timeout: 3000,
                            });
                        }
                    });
            }
        },

        incrementQuantity(service) {
            const authStore = useAuth();
            if (service) {
                axios
                    .post(
                        "/cart/increment",
                        { service_id: service.id },
                        {
                            headers: {
                                Authorization: authStore.token,
                            },
                        }
                    )
                    .then((response) => {
                        this.total = response.data.data.total;
                        this.services = response.data.data.cart_items;
                        this.fetchCheckoutServices();
                    }).catch((error) => {
                        toast.error(error.response.data.message, {
                            position: "bottom-left",
                        })
                    })
            }
        },

        removeFromBasket(service) {
            const authStore = useAuth();
            if (service) {
                axios
                    .post(
                        "/service-cart/delete",
                        { service_id: service.id },
                        {
                            headers: {
                                Authorization: authStore.token,
                            },
                        }
                    )
                    .then((response) => {
                        this.total = response.data.data.total;
                        this.services = response.data.data.cart_items;
                        
                        this.total_amount = response.data.data.checkout.total_amount;
                        this.delivery_charge = response.data.data.checkout.delivery_charge;
                        this.coupon_discount =response.data.data.checkout.coupon_discount;
                        this.payable_amount = response.data.data.checkout.payable_amount;

                        this.fetchCheckoutServices();
                    });
            }
        },

        selectCartItemsForCheckout(shop) {
            if (!this.selectedShopIds.includes(shop)) {
                this.selectedShopIds.push(shop);
            } else {
                this.selectedShopIds = this.selectedShopIds.filter(
                    (item) => item !== shop
                );
            }
            this.fetchCheckoutServices();
        },

        fetchCheckoutServices() {
            const authStore = useAuth();
            if (authStore.token) {
                axios.get("/service-cart/checkout",{
                    headers: {
                        Authorization: authStore.token,
                    },
                }).then((response) => {
                    this.checkoutServices = response.data.data.checkout_items;
                    this.total_amount =
                        response.data.data.checkout.total_amount;
                    this.delivery_charge =
                        response.data.data.checkout.delivery_charge;
                    this.coupon_discount =
                        response.data.data.checkout.coupon_discount;
                    this.payable_amount =
                        response.data.data.checkout.payable_amount;
                    if (this.checkoutServices.length === 0) {
                        this.selectedShopIds = [];
                    }
                }).catch((error) => {
                    console.log(error);
                    toast.error(error.response.data.message);
                });
            }
        },

        checkShopIsSelected(shopId) {
            return this.selectedShopIds.includes(shopId);
        },
    },

    persist: true,
});
