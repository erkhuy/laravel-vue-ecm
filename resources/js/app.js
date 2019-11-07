import Vue from 'vue';
import VueRouter from 'vue-router';
import * as $ from "jquery";
import * as bootstrap from "bootstrap";

import { Form, HasError, AlertError } from 'vform';
import Swal from 'sweetalert2';
import Vue2Filters from 'vue2-filters';
import VCalendar from 'v-calendar';
import { setupCalendar, Calendar } from 'v-calendar';
import store from './store';

import VueCarousel from 'vue-carousel';



//import { routers } from './router/router';
// window.use
window.Vue = require('vue');
window.$ = window.jQuery = require('jquery');
window.Form = Form;
window.Swal = Swal;
window.toast = toast;
Vue.use(VCalendar, {
    firstDayOfWeek: 2,
});

// vue.use
Vue.use(VueRouter)
window.axios = require('axios');
Vue.use(Vue2Filters);
Vue.use(VueCarousel);
// Vue.use(require('@websanova/vue-auth'), {
//         auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
//         http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
//         router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
//     })
// appcintructor

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
// page
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
// backend
import Dashboard from './layouts/Dashboard.vue';
import Home from './layouts/Home.vue';
import example from './components/ExampleComponent.vue';

import Error404 from './components/error404.vue';
import Dhome from './Backend/Dhome.vue';
import User from './Backend/User.vue';
import Product from './Backend/Product.vue';
import RolePermision from './Backend/RolePermision.vue';
import Slide from './Backend/Slide.vue';
import Order from './Backend/Order.vue';
import Coupon from './Backend/Coupon.vue';
import Category from './Backend/Category.vue';
import SizeandColor from './Backend/SizeColor.vue';
import Adminlogin from './layouts/AdminLogin.vue';
import AdminLogout from './layouts/admLogout.vue';
// fronend

import Navbar from './Frontend/Navbar.vue';
// contructor angd option
window.$ = window.jQuery = require('jquery');
let routes = [{
        path: '/admin',
        component: Dashboard,

        meta: {
            requiresAuth: true
        },
        children: [{

                path: '/',
                component: Dhome,
                name: 'Dhome',
                meta: {
                    requiresAuth: true
                },
            },
            {

                path: 'users',
                component: User,
                name: 'User',
                meta: {
                    requiresAuth: true
                },
            },

            {

                path: 'products',
                component: Product,
                name: 'Product',
                meta: {
                    requiresAuth: true
                },
            },
            {

                path: 'slides',
                component: Slide,
                name: 'Slide',
                meta: {
                    requiresAuth: true
                },
            },
            {

                path: 'roles',
                component: RolePermision,
                name: 'RolePermision',
                meta: {
                    requiresAuth: true
                },
            },
            {

                path: 'orders',
                component: Order,
                name: 'Order',
                meta: {
                    requiresAuth: true
                },
            },
            {

                path: 'coupon',
                component: Coupon,
                name: 'Coupon',
                meta: {
                    requiresAuth: true
                },
            },
            {

                path: 'category',
                component: Category,
                name: 'Category',
                meta: {
                    requiresAuth: true
                },
            },
            {

                path: 'sizeandcolor',
                component: SizeandColor,
                name: 'SizeandColor',
                meta: {
                    requiresAuth: true
                },
            },

            {
                path: '*',
                component: Error404,
                name: 'Error404'
            },



        ]
    },
    {
        path: '/admlogin',
        component: Adminlogin,
        name: 'Adminlogin',
        meta: {
            requiresVisitor: true
        },
    },
    {
        path: '/admlogout',
        component: AdminLogout,
        name: 'AdminLogout',
        meta: {
            auth: false
        },
    },

    {
        path: '/',
        component: Home,

        children: [{
                path: '*',
                component: Error404,
                name: 'Error404'
            },

        ]
    },

];
const router = new VueRouter({
    mode: 'history',
    routes
});

// comments
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component('app-main', require('./layouts/App.vue').default);
Vue.component('dashbnoard', require('./layouts/Dashboard.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('v-calendar', Calendar.default);
// fronend
Vue.component('navbar', require('./Frontend/Navbar.vue').default);
Vue.component('main-slide', require('./Frontend/Slide.vue').default);
Vue.component('main-footer', require('./layouts/Footer.vue').default);
Vue.component('main-product', require('./Frontend/Product.vue').default);
Vue.component('new-product', require('./Frontend/NewProductlist.vue').default);

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters.loggedIn) {
            next({
                name: 'Adminlogin',

            })
        } else {
            next()
        }

    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (store.getters.loggedIn) {
            next({
                path: '/admin',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})
const app = new Vue({
    el: '#app',
    store,
    router,

});