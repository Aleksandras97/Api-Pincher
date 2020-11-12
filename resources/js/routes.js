import {createRouter, createWebHashHistory } from 'vue-router';
import Home from './views/Home.vue'
import Profile from './views/Profile.vue'
import SinglePost from './views/SinglePost.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import Logout from './views/Logout.vue'


const routes = [
    {
        path: '/',
        name: 'Home',
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
    },
    {
        path: '/Login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/Register',
        name: 'Register',
        component: Register,
    },
    {
        path: '/Logout',
        name: 'Logout',
        component: Logout,
    }
]

const router  = createRouter({
    history: createWebHashHistory(),
    routes,
    linkActiveClass: 'active'
})

export default router;