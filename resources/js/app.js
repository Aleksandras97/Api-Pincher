require('./bootstrap');

import { createApp } from 'vue'
import Master from './layouts/Master'
import store from './store'
import router from './routes'

require('./store/subscriber')

store.dispatch('attempt', localStorage.getItem('access_token')).then(() => {
    createApp({
        components: {
            Master
        }
        
    }).use(router).use(store).mount('#app')
})


