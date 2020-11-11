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

                <ul class="text-xl mt-6">
                    <li>

                        <router-link class="bg-white py-2 px-4 hover:text-green-800 font-semibold md:block" to="/" exact>Home</router-link>

                    </li>
                    
                    <li>

                        <router-link class="bg-white py-2 px-4 hover:text-green-800 font-semibold md:block" to="/Profile" exact>Profile</router-link>
                    
                    </li>


                </ul>

            </div>

        </nav>       

    </div>
    
</template>

<script>
import { reactive } from 'vue'
    export default {
        setup() {
            const state = reactive({
                isOpen: false,
            });

            function toggle() {
                state.isOpen = !state.isOpen
                console.log(state.isOpen)
            }

            return {
                state,
                toggle
            }
        }
    }
</script>