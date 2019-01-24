import VueRouter from 'vue-router';
import programmeslist from './components/ProgrammesList.vue';
import layout from './components/Layout.vue';
import search from './components/Search.vue';
import login from './components/Login.vue';
import register from './components/Register.vue';
import programmes from './components/Programmes.vue';
import programme from './components/Programme.vue';



let routes = [
    {
        path: '/',
        component: layout
    },
    {
        path: '/programmes',
        component: programmeslist
    },
    {
        path: '/programme',
        component: programme
    }
];


export default new VueRouter({
    routes
});