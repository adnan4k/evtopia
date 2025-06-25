import { createRouter, createWebHistory } from 'vue-router'
import axios from 'axios'

/* master + auth stores */
import { useMaster } from '@/stores/MasterStore'
import { useAuth }   from '@/stores/authStore'

/* layouts (needed for meta) */
import defaultLayout from '@/layouts/default.vue'
import authLayout    from '@/layouts/auth.vue'
import layoutBlank   from '@/layouts/blank.vue'

/* -------- lazy page imports -------- */
const Home               = () => import('@/pages/Home.vue')
const HowEvWorks         = () => import('@/pages/HowEvWorks.vue')
const Shop               = () => import('@/pages/Shop.vue')
const Blog               = () => import('@/pages/Blog.vue')
const KnowledgeHub       = () => import('@/pages/KnowledgeHub.vue')
const Services           = () => import('@/pages/Services.vue')
const ShopDetails        = () => import('@/pages/ShopDetails.vue')
const BlogDetail         = () => import('@/pages/BlogDetail.vue')
const KnowledgeHubDetail = () => import('@/pages/KnowledgeHubDetail.vue')
const ShopCategoryProduct= () => import('@/pages/ShopCategoryProduct.vue')
const ProductDetails     = () => import('@/pages/ProductDetails.vue')
const ServiceDetails     = () => import('@/pages/ServiceDetails.vue')
const CategoryProduct    = () => import('@/pages/CategoryProduct.vue')
const Checkout           = () => import('@/pages/Checkout.vue')
const CheckoutVerify     = () => import('@/pages/CheckoutVerify.vue')

const Dashboard       = () => import('@/pages/Dashboard.vue')
const OrderHistory    = () => import('@/pages/OrderHistory.vue')
const BookingHistory  = () => import('@/pages/BookingHistory.vue')
const OrderDetails    = () => import('@/pages/OrderDetails.vue')
const BookingDetails  = () => import('@/pages/BookingDetails.vue')
const Wishlist        = () => import('@/pages/Wishlist.vue')
const MyProfile       = () => import('@/pages/MyProfile.vue')
const ManageAddress   = () => import('@/pages/ManageAddress.vue')
const Support         = () => import('@/pages/Support.vue')
const TermsAndConditions = () => import('@/pages/TermsAndConditions.vue')
const PrivacyPolicy   = () => import('@/pages/PrivacyPolicy.vue')
const AddNewAddress   = () => import('@/pages/AddNewAddress.vue')
const EditAddress     = () => import('@/pages/EditAddress.vue')
const AboutUs         = () => import('@/pages/AboutUs.vue')
const ChangePassword  = () => import('@/pages/ChangePassword.vue')
const BuyNow          = () => import('@/pages/BuyNow.vue')
const MostPopular     = () => import('@/pages/MostPopular.vue')
const MostSpecial     = () => import('@/pages/MostSpecial.vue')
const ContactUs       = () => import('@/pages/ContactUs.vue')
const BestDeal        = () => import('@/pages/BestDeal.vue')
const Products        = () => import('@/pages/Products.vue')
const Product         = () => import('@/pages/Product.vue')
const Category        = () => import('@/pages/Category.vue')
const SupportTicket   = () => import('@/pages/SupportTicket.vue')
const SupportTicketDetails = () => import('@/pages/SupportTicketDetails.vue')

const NotFound        = () => import('@/errors/404.vue')

/* -------- route definitions (unchanged) -------- */
const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
        meta: {
            layout: defaultLayout,
            title: "Home",
        },
    },

    {
        path: "/all_products",
        name: "all_products",
        component: Product,
        meta: {
            layout: defaultLayout,
            title: "Product",
        },
    },
    {
        path: "/shops",
        name: "shop",
        component: Shop,
        meta: {
            layout: defaultLayout,
            title: "Shops",
        },
    },


    {
        path: "/blog",
        name: "blog",
        component: Blog,
        meta: {
            layout: defaultLayout,
            title: "News and Updates",
        },
    },

    {
        path: "/knowledge-center",
        name: "knowledge_hub",
        component: KnowledgeHub,
        meta: {
            layout: defaultLayout,
            title: "Knowledge Center",
        },
    },

    {
        path: "/services",
        name: "services",
        component: Services,
        meta: {
            layout: defaultLayout,
            title: "Services",
        },
    },
    {
        path: "/products",
        name: "products",
        component: Products,
        meta: {
            layout: defaultLayout,
            title: "Products",
        },
    },

    {
        path: "/how-ev-works",
        name: "how-ev-works",
        component: HowEvWorks,
        meta: {
            layout: defaultLayout,
            title: "How Electric Vehicle Works ?",
        },
    },
    {
        path: "/brands",
        name: "brands",
        component: Category,
        meta: {
            layout: defaultLayout,
            title: "Brands",
        },
    },
    {
        path: "/popular-products",
        name: "popular-products",
        component: MostPopular,
        meta: {
            layout: defaultLayout,
            title: "Most Popular Products",
        },
    },

        {
        path: "/special-offers",
        name: "special-offers",
        component: MostSpecial,
        meta: {
            layout: defaultLayout,
            title: "Special Products",
        },
    },
    {
        path: "/special-offers",
        name: "special-offers",
        component: BestDeal,
        meta: {
            layout: defaultLayout,
            title: "Special Offers Products",
        },
    },
    {
        path: "/shops/:id",
        name: "shop-detail",
        component: ShopDetails,
        meta: {
            layout: defaultLayout,
            title: "Shop Details",
        },
    },

    {
        path: "/blogs/:id",
        name: "blog-detail",
        component: BlogDetail,
        meta: {
            layout: defaultLayout,
            title: "Blog Details",
        },
    },

    {
        path: "/knowledge-center/:id",
        name: "knowledge_hub_detail",
        component: KnowledgeHubDetail,
        meta: {
            layout: defaultLayout,
            title: "Knowledge Hub Details",
        },
    },
    {
        path: "/shops/:id/brands/:slug",
        name: "shop-category-product",
        component: ShopCategoryProduct,
        meta: {
            layout: defaultLayout,
            title: "Shop Brands Product",
        },
    },
    {
        path: "/products/:id/details",
        name: "productDetails",
        component: ProductDetails,
        meta: {
            layout: defaultLayout,
            title: "Product Details",
        },
    },

    {
        path: "/services/:id/details",
        name: "serviceDetails",
        component: ServiceDetails,
        meta: {
            layout: defaultLayout,
            title: "Service Details",
        },
    },
    {
        path: "/brands/:slug",
        name: "category-product",
        component: CategoryProduct,
        meta: {
            layout: defaultLayout,
            title: "Category Products",
        },
    },
    {
        path: "/checkout",
        name: "checkout",
        component: Checkout,
        meta: {
            layout: defaultLayout,
            title: "Checkout",
        },
    },

    {
        path: "/verify_payment/:id",
        name: "verify_payment",
        component: CheckoutVerify,
        meta: {
            layout: defaultLayout,
            title: "CheckoutVerify",
        },
    },


    {
        path: "/buynow",
        name: "buynow",
        component: BuyNow,
        meta: {
            layout: defaultLayout,
            title: "Buy Now",
        },
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: Dashboard,
        meta: {
            layout: authLayout,
            title: "Dashboard",
            
        },
    },
    {
        path: "/order-history",
        name: "order-history",
        component: OrderHistory,
        meta: {
            layout: authLayout,
            title: "Order History",
        },
    },

    {
        path: "/booking-history",
        name: "booking-history",
        component: BookingHistory,
        meta: {
            layout: authLayout,
            title: "Booking History",
        },
    },
    {
        path: "/order-history/:id",
        name: "order-details",
        component: OrderDetails,
        meta: {
            layout: authLayout,
            title: "Order Details",
        },
    },

    {
        path: "/booking-history/:id",
        name: "booking-details",
        component: BookingDetails,
        meta: {
            layout: authLayout,
            title: "Booking Details",
        },
    },

    {
        path: "/wishlist",
        name: "wishlist",
        component: Wishlist,
        meta: {
            layout: authLayout,
            title: "Wishlist",
        },
    },
    {
        path: "/profile",
        name: "profile",
        component: MyProfile,
        meta: {
            layout: authLayout,
            title: "My Profile",
        },
    },
    {
        path: "/manage-address",
        name: "manage-address",
        component: ManageAddress,
        meta: {
            layout: authLayout,
            title: "Manage Address",
        },
    },
    {
        path: "/manage-address/new",
        name: "add-new-address",
        component: AddNewAddress,
        meta: {
            layout: authLayout,
            title: "Add New Address",
        },
    },
    {
        path: "/manage-address/:id/edit",
        name: "edit-address",
        component: EditAddress,
        meta: {
            layout: authLayout,
            title: "Edit Address",
        },
    },
    {
        path: "/change-password",
        name: "change-password",
        component: ChangePassword,
        meta: {
            layout: authLayout,
            title: "Change Password",
        },
    },
    {
        path: "/support-tickets",
        name: "support-ticket",
        component: SupportTicket,
        meta: {
            layout: authLayout,
            title: "Support Ticket",
        },
    },
    {
        path: "/support-ticket/:ticketNumber",
        name: "support-ticket-details",
        component: SupportTicketDetails,
        meta: {
            layout: authLayout,
            title: "Support Ticket Details",
        },
    },

    {
        path: "/support",
        name: "support",
        component: Support,
        meta: {
            layout: defaultLayout,
            title: "Support",
        },
    },
    {
        path: "/terms-and-conditions",
        name: "terms-and-conditions",
        component: TermsAndConditions,
        meta: {
            layout: defaultLayout,
            title: "Terms & Conditions",
        },
    },
    {
        path: "/privacy-policy",
        name: "privacy-policy",
        component: PrivacyPolicy,
        meta: {
            layout: defaultLayout,
            title: "Privacy Policy",
        },
    },
    {
        path: "/about-us",
        name: "about-us",
        component: AboutUs,
        meta: {
            layout: defaultLayout,
            title: "About Us",
        },
    },
    {
        path: "/contact-us",
        name: "contact-us",
        component: ContactUs,
        meta: {
            layout: defaultLayout,
            title: "Contact Us",
        },
    },
    {
        path: "/:pathMatch(.*)*",
        name: "not-found",
        component: NotFound,
        meta: {
            title: "Page Not Found",
            layout: layoutBlank,
        },
    },
];
/* tag authLayout routes as protected */
routes.forEach((r) => {
    if (r.meta?.layout === authLayout) r.meta.requiresAuth = true
  })
  
  /* ---------- create router ---------- */
  const router = createRouter({
    history: createWebHistory(),
    routes,
  })
  
  /* ---------- navigation guard ---------- */
  router.beforeEach(async (to, _from, next) => {
    const auth = useAuth()
  
    /* 1️⃣  pull latest token from localStorage on EVERY nav */
    const persisted = localStorage.getItem('authStore')
    if (persisted) {
      try {
        const { token } = JSON.parse(persisted) ?? {}
        if (token && token !== auth.token) auth.token = token
      } catch {/* ignore JSON errors */}
    }
  
    /* 2️⃣  sync Axios header every nav */
    if (auth.token) {
      axios.defaults.headers.common.Authorization = auth.token
    } else {
      delete axios.defaults.headers.common.Authorization
    }
  
    if (to.meta.requiresAuth) {
        if (!auth.token) {
          auth.loginModal = true
          return next({ name: 'home' })
        }
    
        try {
          const res = await axios.get('/me', {
            headers: { Authorization: `Bearer ${auth.token}` }
          })
    
          console.log('user', res)
          const newToken = res?.data?.data?.access?.token
          if (newToken && newToken !== auth.token) {
            auth.setToken(newToken)        
            axios.defaults.headers.common.Authorization = `Bearer ${newToken}`
          }
    
          return next()                    
        } catch (err) {
            auth.logout()           
            // auth.loginModal = true  
            next(false)                              
            window.location.href = '/' 
        }
      }
  
    /* 4️⃣  public route */
    return next()
  })
  
  /* ---------- page titles ---------- */
  router.afterEach((to) => {
    const appName = useMaster().appName
    document.title = to.meta.title ? `${to.meta.title} - ${appName}` : appName
  })
  
  export default router