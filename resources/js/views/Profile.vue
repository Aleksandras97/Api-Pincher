<template>
    
    <div class="p-12 md:p-12 text-center lg:text-left">
        <!-- Image for mobile view-->
        <div class="block rounded-full shadow-xl mx-auto md:mx-0 -mt-8 h-48 w-48 bg-cover bg-center" style="background-image: url('https://i.pravatar.cc/3500')"></div>
        
        <h1 class="text-3xl font-bold pt-8 lg:pt-0">{{ authUser.name }}</h1>
        <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-teal-500 opacity-25"></div>
        
        <p class="pt-8 text-sm">@ {{ authUser.username }}</p>
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

        <Post v-for="post in state.posts" :key="post.id" :post="post"></Post>
        
    </div>

    
</template>


<script>
import { computed, onMounted, reactive } from 'vue'
import { useStore } from 'vuex'
import Post from '../components/Post'

export default {
    components: {
        Post
    },
    setup(){
        const store = useStore();
        const state = reactive({
            posts: [],
            user: null,
        })

        
        const count = computed(() => store.state.count);

        const authUser = computed(() => store.getters.authUser)
            

        function increment() {
            store.commit("increment");
        }
        
        function decrement() {
            store.commit("decrement");
        }

        onMounted( async () => {

            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token

            const posts = await axios.get(`/api/users/41/posts`)
            .then(response => {
                return response.data.data
            })

            state.posts = posts

            // state.user = store.state.user
        })

        return {
            state,
            count,
            increment,
            decrement,
            authUser
        }
    }
}
</script>
