<template>

    <div class="">

        <CreatePostPanel @add-post="addPost"></CreatePostPanel>


        <h4 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Latests Posts</h4>

        <!-- posts -->
        <Post v-for="post in state.user.posts" :key="post.id" :username="state.user.username" :post="post"></Post>

    </div>


</template>


<script>
import { reactive } from 'vue';
import Post from "./Post"
import CreatePostPanel from "./CreatePostPanel"

export default {
    components: {
        Post,
        CreatePostPanel
    },
    setup(props, ctx) {
        const state = reactive({
            user: {
                id: 1,
                username: 'Aleksandr',
                isAdmin: true,
                posts: [
                    { id: 1, body: 'First post test' },
                    { id: 2, body: 'Second post'},
                ]
            }
        });

        function addPost(post) {
            state.user.posts.unshift({
                id: state.user.posts.length + 1,
                body: post,
            });
        }

        return {
            state,
            addPost
        }
    },
}
</script>


<style scoped>

</style>