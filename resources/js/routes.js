import { createRouter, createWebHashHistory } from 'vue-router';
import Home from './views/Home.vue'
import Profile from './views/Profile.vue'
import SinglePost from './views/SinglePost.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import Logout from './views/Logout.vue'
import store from './store';
import Explore from './views/Explore.vue'


const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            requiresAuth: true
        }

    },
    {
        path: '/profile/:username',
        name: 'Profile',
        component: Profile,
        meta: {
            requiresAuth: true
        }

    },
    {
        path: '/post/:postId',
        name: 'SinglePost',
        component: SinglePost,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
      path: '/explore',
      name: 'Explore',
      component: Explore,
      meta: {
          requiresAuth: true
      }
  },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: '/logout',
        name: 'Logout',
        component: Logout,
    }
]

const router  = createRouter({
    history: createWebHashHistory(),
    routes,
    linkActiveClass: 'active'
})

router.beforeEach( async (to, from , next) => {


    if(to.matched.some(record => record.meta.requiresAuth)) {

        if(!store.getters.authenticated) {
            next({
                name: 'Login',
            })
        } else {
            next()
        }

    } else if (to.matched.some(record => record.meta.requiresVisitor)) {

        if(store.getters.authenticated) {
            next({
                name: 'Home',
            })
        } else {
            next()
        }

    } else {
        next()
    }
})

export default router;
