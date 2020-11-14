<template>
    <div class="md:pt-8 pb-6 px-2 md:px-0 bg-white">
    <div class="gb-white max-w-lg mx-auto">
        <a href="">
            <h1 class="text-4xl font-bold text-black text-center">Register</h1>
        </a>
    </div>
    
    <div class="gb-white max-w-lg mx-auto p-8 md:p-8 my-5">
        <section>
            <h3 class="font-bold text-2xl">Welcome to Pincher</h3>
            <p class="text-gray-700 pt-2">Register for new account</p>
        </section>

        <section class="mt-10">
            <form action="#" class="flex flex-col" @submit.prevent="register">

                <div class="mb-6 pt-3 rounded bg-gray-200">
                  <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="username">Username</label>
                  <input type="text" name="username" id="username" class="login-input" autocomplete="off" v-model="state.username">
                </div>

                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="name">Name</label>
                    <input type="text" name="name" id="name" class="login-input" autocomplete="off" v-model="state.name">
                </div>
                
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input type="text" id="email" class="login-input" autocomplete="off" v-model="state.email">
                </div>

                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input type="password" id="password" class="login-input" v-model="state.password">
                </div>


                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200">Register</button>
            </form>
        </section>
    </div>

    <div class=" max-w-lg mx-auto text-center mt-12 mb-6">
        <p class="text-black">Already have an account?  <a class="font-bold hover:underline" href="#">Log In</a> 
        </p>
    </div>
</div>
</template>

<script>
import { reactive } from 'vue'
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
export default {
    setup(){
        const store = useStore();
        const router = useRouter();

        const state = reactive({
            username: '',
            name: '',
            email: '',
            password: '',
        });

        function register() {
            store.dispatch('register', {
                username: state.username,
                name: state.name,
                email: state.email,
                password: state.password,
            })
                .then(responce => {
                    router.push({ name: 'Login'})
                })
        }

        return {
            state,
            register
        }
    }
}
</script>