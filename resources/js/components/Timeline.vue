<template>


        <CreatePostPanel @add-post="addPost"></CreatePostPanel>


        <h4 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Latests Posts</h4>

        <!-- posts -->
        <router-link v-for="post in state.posts" :key="post.id" :to="{ name: 'SinglePost', params: { postId: post.id } }">
            <Post :post="post"></Post>
        </router-link>
        



</template>


<script>
import { onMounted, reactive, ref } from 'vue';
import Post from "./Post"
import CreatePostPanel from "./CreatePostPanel"

export default {
    components: {
        Post,
        CreatePostPanel
    },
    setup(props, ctx) {

        const state = reactive({
            posts: []
        });

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

        onMounted(() => {
            axios.get('/api/posts').then(
                response => state.posts = response.data.data
                
                );
        })

        return {
            state,
            addPost
        }
    },
}
</script>


<style scoped>

</style>