require('./bootstrap');

import { createApp } from 'vue'
import Home from './components/Home'
import WritePost from  './components/WritePost.vue';
import Timeline from './components/Timeline.vue';
import Navbar from './components/Navbar.vue';


createApp({
    components: { 
        Home,
        WritePost,
        Timeline,
        Navbar
    },
}).mount('#app')
