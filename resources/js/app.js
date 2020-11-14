require('./bootstrap');

import { createApp } from 'vue'
import Master from './layouts/Master'
import store from './store'
import router from './routes'



createApp({
    components: {
        Master
    }
    
}).use(router).use(store).mount('#app')
