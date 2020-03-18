require('./bootstrap');

window.Vue = require('vue');

import Vuetify from '../plugins/vuetify'

import store from "./store"

import router from "./router"

Vue.component('login-form', require('./components/login/loginForm.vue').default);
Vue.component('app-store', require('./components/appStore.vue').default);


const app = new Vue({
    vuetify: Vuetify,
    store,
    router,
    el: '#app',
});
