/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * We will create a fresh Vue application instance and attach it to
 * the page.
 */

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import App from './components/App';

import store from './vuex-store';
import router from "./router-setup";

const app = new Vue({
    el: '#quizzes',
    components: {
        // Main component
        App
    },
    router,
    store
});
