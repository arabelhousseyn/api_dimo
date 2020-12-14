/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import common from './common.js'
Vue.mixin(common);

import secretPage from './pages/secretPage.vue'
import homePage from './pages/homePage.vue'
import router from './router.js'

const app = new Vue({
    el: '#app',
    components : {
        secretPage,
        homePage,
    },
    router
});
