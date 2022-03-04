import Vue from 'vue'   // in Vue 2
import axios from 'axios'
import VueAxios from 'vue-axios'
require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(VueAxios, axios)
Vue.component('Todo', require('./components/Todo.vue').default);

const app = new Vue({
    el: '#app',
});
