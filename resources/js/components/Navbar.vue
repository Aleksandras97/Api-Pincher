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

                            <router-link class="bg-white hover:text-green-800 font-semibold md:block" :to="{ name: 'Profile', params: { username: user?.username } }" exact>Profile</router-link>
                            <!-- {{ user.username }} -->
                        </li>

                        <li class="p-2">

                                <router-link class="bg-white hover:text-green-800 font-semibold md:block" :to="{ name: 'Logout'}" exact>Logout</router-link>

                        </li>

                        <div class="bg-gray-200 py-4 px-6 mx-auto rounded">
                            <h1 class="font-bold text-lg mb-4">Following</h1>
                            <div class="flex md:block">
                                <router-link v-for="follow in followingUsers" :key="follow.id" :to="{ name: 'Profile', params: { username: follow.username } }" exact class="mb-4">

                                    <div class=" flex mb-2 md:items-center text-sm">

                                        <div class="rounded-full mr-2">
                                            <img :src="`https://i.pravatar.cc/3500?u=${ follow.email }`" alt="avatar" class="rounded-full mr-2 w-10">
                                        </div>

                                        <li>


                                          <h1>{{follow.name}}</h1>

                                        </li>

                                    </div>

                                </router-link>
                            </div>

                        </div>


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
import { reactive, computed, onMounted } from 'vue'
import { useStore } from 'vuex';
    export default {
        setup() {
            const store = useStore();
            const state = reactive({
                isOpen: false,
                following: []
            });

            const authenticated = computed(() => store.getters.authenticated)

            const user = computed(() => store.getters.authUser)

            const followingUsers = computed(() => store.getters.followingUsers)

            function toggle() {
                state.isOpen = !state.isOpen
                console.log(state.isOpen)
            }

            onMounted( async () => {
            })

            return {
                state,
                toggle,
                authenticated,
                user,
                followingUsers
            }
        }
    }
</script>
