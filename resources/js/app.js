
require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
Vue.use(Vuetify);

import Dashboard from './components/admin/Dashboard.vue'
import Users from './components/admin/User.vue'
import Campuses from './components/admin/Campus.vue'
import Programs from './components/admin/Program.vue'

const router = new VueRouter ({
    mode : 'history',
    routes : [

        {
            path : '/admin/dashboard',
            component : Dashboard,
            name : 'dashboard'
        },

        {
            path : '/admin/users',
            component : Users,
            name : 'users'
        },

        {
            path : '/admin/campuses',
            component : Campuses,
            name : 'campuses'
        },

        {
            path : '/admin/programs',
            component : Programs,
            name : 'programs'
        },

    ]

})

Vue.component('admin-navigation', require('./components/admin/Navigation.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router
});
