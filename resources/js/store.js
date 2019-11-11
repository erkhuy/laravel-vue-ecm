import Vue from "vue";
import Vuex from "vuex";
import { reject } from "q";
import { constants } from "crypto";

Vue.use(Vuex);
let cart = window.localStorage.getItem("cart");
export default new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
        cart: cart ? JSON.parse(cart) : [],
        buynow: '',
    },
    getters: {
        loggedIn(state) {
            return state.token != null;
        }
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token;
        },
        destroyToken(state) {
            state.token = null;
        },
        addToCart(state, payload) {
            let found = state.cart.indexOf(payload);
            console.log(found);
            if (found > 0) {
                state.cart[found] = payload;
            } else {
                state.cart.push(payload);
            }

            console.log(JSON.stringify(state.cart));

            this.commit("saveData");
        },
        saveData(state) {
            localStorage.setItem("cart", JSON.stringify(state.cart));
        },
        removeFromcart(state, payload) {

            let index = state.cart.indexOf(payload);
            state.cart.splice(index, 1);
            this.commit("saveData");

        },
        removeAllCart() {
            localStorage.removeItem('cart');
        }
    },
    actions: {
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/api/auth/login', {
                        email: credentials.email,
                        password: credentials.password,
                    })
                    .then((response) => {
                        const token = response.data.access_token;
                        localStorage.setItem('access_token', token);
                        context.commit('retrieveToken', token);
                        resolve(response);
                    })
                    .catch((error) => {
                        reject(error);
                    });
            });
        },
        destroyToken(context) {
            const getLogout = axios({ method: 'post', url: '/api/auth/logout', headers: { Authorization: 'Bearer ' + context.state.token } });
            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    getLogout
                        .then(response => {
                            console.log(response);
                            localStorage.removeItem('access_token');
                            context.commit('destroyToken');
                            resolve(response);
                        })
                        .catch(error => {
                            localStorage.removeItem('access_token');
                            context.commit('destroyToken');
                            reject(error);
                        })
                })
            }
        },

    }
});