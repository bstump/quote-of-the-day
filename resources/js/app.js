/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import QuoteOfTheDay from '@/js/views/QuoteOfTheDay'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: QuoteOfTheDay,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { QuoteOfTheDay },
    router
});