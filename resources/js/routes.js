import {createRouter, createWebHashHistory } from 'vue-router';
import Home from './views/Home.vue'
import Profile from './views/Profile.vue'


const routes = [
    {
        path: '/',
        component: Home
        
    },
    {
        path: '/Profile',
        component: Profile
        
    }
]

const router  = createRouter({
    history: createWebHashHistory(),
    routes,
    linkActiveClass: 'active'
})

export default router;