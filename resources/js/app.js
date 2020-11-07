require('./bootstrap');

import { createApp } from 'vue'
import Navbar from './components/Navbar.vue'
import router from './routes'


createApp({
    components: {
        Navbar
    }
    
}).use(router).mount('#app')
