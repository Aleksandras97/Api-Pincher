<template>
    
    <div class="p-12 md:p-12 text-center lg:text-left">
        <!-- Image for mobile view-->
        <!-- <div class="block rounded-full shadow-xl mx-auto md:mx-0 -mt-8 h-48 w-48 bg-cover bg-center" style="background-image: url('https://i.pravatar.cc/3500')"></div> -->
        <div class="block rounded-full shadow-xl mx-auto md:mx-0 -mt-8 h-48 w-48 bg-cover bg-center">
            <img :src="`https://i.pravatar.cc/3500?u=${ state.user.email }`" alt="avatar" class="rounded-full">
        </div>
        <h1 class="text-3xl font-bold pt-8 lg:pt-0">{{ state.user.name }}</h1>
        <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-teal-500 opacity-25"></div>
        
        <p class="pt-8 text-sm">@ {{ state.user.username }}</p>
        <p>Count: {{ count }}</p>
        <button @click="increment()">Increment</button>
        <button @click="decrement()">Decrement</button>

        <div class="pt-12 pb-8">
            <button class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded-full">
                Get In Touch
            </button> 
        </div>


    </div>

    <!-- <router-link v-for="post in state.posts" :key="post.id" :to="{ name: 'SinglePost', params: { postId: post.id } }">
        <Post :post="post"></Post>
    </router-link> -->
    <div class="md:border-t md:border-gray-500">

        <Post v-for="post in state.user.posts" :key="post.id" :post="post"></Post>
        
    </div>

    
</template>


<script>
import { computed, onMounted, reactive } from 'vue'
import { useStore } from 'vuex'
import Post from '../components/Post'
import { useRoute } from 'vue-router'

export default {
    components: {
        Post
    },
    setup(){
        const store = useStore();
        const route = useRoute();
        const state = reactive({
            user: {},
        })

        
        const count = computed(() => store.state.count);

        const authUser = computed(() => store.getters.authUser)

        const name = computed(() => route.params.username)
        // const username = 'Marcella'

        function increment() {
            store.commit("increment");
        }
        
        function decrement() {
            store.commit("decrement");
        }

        onMounted( async () => {

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.Auth.token


            const user = await axios.get(`api/profiles/${name.value}`)
            .then(response => {
                state.user = response.data.data
            })

            // state.user = user
            // console.log(user)
        })

        return {
            state,
            count,
            increment,
            decrement
        }
    }
}
</script>
