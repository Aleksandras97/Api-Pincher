<template>

    <div class="md:col-span-1 md:flex md:justify-end"> <!-- Start nav -->
                
        <nav class="pr-12">
            <div class="flex justify-between items-center">
                <h1 class="font-bold uppercase p-4 border-b border-gray-100">
                    <p>Pincher</p>
                </h1>
                <div  class="p-4 md:hidden">
                    <button @click="toggle">

                        <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>   

                    </button>
                </div>
            </div>
            <div :class="state.isOpen ? 'block' : 'hidden'" class="md:flex">

                <ul class="text-xl mt-6" >

                    <template v-if="authenticated">
                        <li class="p-2">

                            <router-link class="bg-white hover:text-green-800 font-semibold md:block" :to="{ name: 'Home'}" exact>Home</router-link>

                        </li>
                        
                        <li class="p-2">

                            <router-link class="bg-white hover:text-green-800 font-semibold md:block" :to="{ name: 'Profile', params: { username: user?.username } }" exact>Profile of</router-link>
                            <!-- {{ user.username }} -->
                        </li>

                        <li class="p-2">
                            
                                <router-link class="bg-white hover:text-green-800 font-semibold md:block" :to="{ name: 'Logout'}" exact>Logout</router-link>

                        </li>
                    </template>

                    
                    <template v-else>
                        <li class="p-2">
                            <router-link class="bg-white hover:text-green-800 font-semibold md:block" :to="{ name: 'Login'}" exact>Login</router-link>  

                        </li>

                        <li class="p-2">
                            <router-link class="bg-white hover:text-green-800 font-semibold md:block" :to="{ name: 'Register'}" exact>Register</router-link>
                        </li>
                    </template>


                </ul>

            </div>

        </nav>       

    </div>
    
</template>

<script>
import { reactive, computed } from 'vue'
import { useStore } from 'vuex';
    export default {
        setup() {
            const store = useStore();
            const state = reactive({
                isOpen: false,
            });
            
            const authenticated = computed(() => store.getters.authenticated)

            const user = computed(() => store.getters.authUser)

            function toggle() {
                state.isOpen = !state.isOpen
                console.log(state.isOpen)
            }

            return {
                state,
                toggle,
                authenticated,
                user
            }
        }
    }
</script>