<template>
<div class="md:pt-8 pb-6 px-2 md:px-0 bg-white">
    <div class="gb-white max-w-lg mx-auto">
            <h1 class="text-4xl font-bold text-black text-center">Log In</h1>
            <div class="flex justify-center mt-2">
              <Spinner/>
            </div>
    </div>

    <div class="gb-white max-w-lg mx-auto p-8 md:p-8 my-5">
        <section>
            <h3 class="font-bold text-2xl">Welcome to Pincher</h3>
            <p class="text-gray-700 pt-2">Log In to your account</p>

        </section>

        <section class="mt-10">
            <form action="" @submit.prevent="login" class="flex flex-col">

                <div v-if="state.serverError" class="mb-2 text-sm py-2 px-3 bg-pink-200 text-red-700 rounded">{{ state.serverError }}</div>

                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input type="text" name="username"  id="username" class="login-input" v-model="state.username">
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input type="password" name="password" id="password" class="login-input" v-model="state.password">
                </div>
                <div class="flex justify-end">
                    <a href="#" class=" text-sm text-purple-600 hover:underline mb-6">Forgot your password?</a>
                </div>
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200">
                  Log In
                  </button>
            </form>
        </section>


    </div>

    <div class=" max-w-lg mx-auto text-center mt-12 mb-6">
        <p class="text-black">Don't have an account?  <router-link class="font-bold hover:underline" :to="{ name: 'Register'}" exact>Register</router-link>
        </p>
    </div>
</div>

</template>

<script>
import { reactive } from 'vue';
import { useStore } from 'vuex'
import { useRouter } from 'vue-router';
import Spinner from '../components/Spinner'

export default {
    components: {
      Spinner
    },
    setup(){
        const router = useRouter();
        const store = useStore();

        const state = reactive({
            username: '',
            password: '',
            serverError: '',
        });

        function login() {

            store.dispatch('signIn', {
                username: state.username,
                password: state.password,
            })
                .then(() => {
                    router.push({ name: 'Home'})
                })
                .catch(error => {
                    state.serverError = error.response.data
                    state.password = ''
                })

        }

        return {
            state,
            login
        }
    }
}
</script>
