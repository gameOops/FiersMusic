import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import album from './views/Album'
import Home from './views/Home'
import Artist from './views/Artist'
import Search from './views/Search'
import Auth from './views/Auth'
import Add from './views/Add'
import User from './views/User'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/search',
            name: 'search',
            component: Search
        },
        {
            path: '/add',
            name: 'add',
            component: Add
        },
        {
            path: '/auth',
            name: 'auth',
            component: Auth
        },
        {
            path: '/album:id',
            name: 'album',
            props: true,
            component: album,
        },
        {
            path: '/artist:id',
            name: 'artist',
            props: true,
            component: Artist,
        },
        {
            path: '/user:id',
            name: 'user',
            props: true,
            component: User,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
})

