require('./bootstrap');

import { createApp } from 'vue'
import Navbar from './components/Navbar.vue'
import store from './store'
import router from './routes'



createApp({
    components: {
        Navbar
    }
    
}).use(router).use(store).mount('#app')
