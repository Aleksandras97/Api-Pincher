<template>
    <div class="grid md:grid-cols-3"> 

        <Navbar></Navbar>
        
        <main class=" px-4 md:col-span-2" style="max-width: 650px">

            <div class="p-3 flex justify-center md:justify-end md:border-r md:border-l  border-gray-500">
             <router-link v-if="!state.loggedin" class="btn hover:bg-teal-900" :to="{ name: 'Login'}" >Login</router-link> 
             <router-link v-if="!state.loggedin" class="btn hover:bg-teal-900 mx-2" :to="{ name: 'Register'}" >Register</router-link>
             <router-link v-if="state.loggedin" class="btn hover:bg-teal-900" :to="{ name: 'Logout'}" >Logout</router-link> 
             <li v-if="state.loggedin">Hello {{ state.loggedin }}</li>
             
                
                
            </div>

            <div class="md:border md:border-gray-500 shadow-2xl bg-white lg:mx-0">

                <router-view></router-view>
                
            </div>
        


        </main>
            
    </div> 
</template>

<script>
import { onMounted, reactive } from 'vue'
import { useStore } from 'vuex';
import Navbar from '../components/Navbar'
export default {
    components: {
        Navbar
    },
    setup(){
        const store = useStore();

        const state = reactive({
            loggedin: store.getters.loggedIn,
        });

        return {
            state
        }
    }
}
</script>