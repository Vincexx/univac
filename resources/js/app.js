
require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
Vue.use(Vuetify);


Vue.component('admin-navigation', require('./components/admin/Navigation.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});
