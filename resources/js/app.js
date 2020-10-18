/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(axios, VueAxios)
import moment from 'moment'



Vue.filter('dateformat',(arg)=> {
    return moment(arg).format("DD MMM YYYY");
})

Vue.filter('timeformat',(arg)=> {
    return moment(arg).format("h:mm a");
})

Vue.filter('capitalizeFirstLetter',(string)=>{
    return string.charAt(0).toUpperCase() + string.slice(1);
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('advance-component', require('./components/AdvanceComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.$axios = axios;
const app = new Vue({
    el: '#app',
});
