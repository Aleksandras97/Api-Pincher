<template>

        
        {{ user?.username }} {{ authenticated }}

        <CreatePostPanel @add-post="addPost"></CreatePostPanel>


        <h4 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Latests Posts</h4>

        <!-- posts -->
        <div v-for="post in state.posts" :key="post.id" >
            <Post :post="post"></Post>
        </div>
        
        



</template>


<script>
import { onMounted, reactive, computed } from 'vue';
import Post from "./Post"
import CreatePostPanel from "./CreatePostPanel"
import { useStore } from 'vuex';

export default {
    components: {
        Post,
        CreatePostPanel
    },
    setup(props, ctx) {
        const store = useStore();
        const state = reactive({
            posts: []
        });

        const authenticated = computed(() => store.getters.authenticated)

        const user = computed(() => store.getters.authUser)

        function addPost(post) {
            // axios.post('api/posts', {

            // })
            //     .then(response => {

            //     })
            // state.user.posts.unshift({
            //     id: state.user.posts.length + 1,
            //     body: post,
            // });
        }

        onMounted( async () => {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.Auth.token

            await axios.get('/api/posts').then(
                response => state.posts = response.data.data
                
                );
        })

        return {
            state,
            addPost,
            user,
            authenticated
        }
    },
}
</script>


<style scoped>

</style>