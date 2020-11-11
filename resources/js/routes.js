import {createRouter, createWebHashHistory } from 'vue-router';
import Home from './views/Home.vue'
import Profile from './views/Profile.vue'
import SinglePost from './views/SinglePost.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'


const routes = [
    {
        path: '/',
        component: Home
        
    },
    {
        path: '/Profile',
        component: Profile
        
    },
    {
        path: '/Post/:postId',
        name: 'SinglePost',
        component: SinglePost,
        props: true
    },
    {
        path: '/Login',
        name: 'Login',
        component: Login,
        props: true
    },
    {
        path: '/Register',
        name: 'Register',
        component: Register,
        props: true
    }
]

const router  = createRouter({
    history: createWebHashHistory(),
    routes,
    linkActiveClass: 'active'
})

export default router;