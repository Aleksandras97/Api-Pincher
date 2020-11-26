<template>


        <CreatePostPanel @add-post="addPost"></CreatePostPanel>

        <h4 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Latests Posts</h4>

        <!-- posts -->
        <transition-group name="fade" enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">
            <div v-for="(post, index) in state.posts" :key="post.id" >
                <Post @delete-post="deletePost" :post="post" :index="index"></Post>
            </div>
        </transition-group>




</template>


<script>
import { onMounted, reactive, computed } from 'vue';
import Post from "./Post"
import CreatePostPanel from "./CreatePostPanel"
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

export default {
    components: {
        Post,
        CreatePostPanel
    },
    setup(props, ctx) {
        const store = useStore();
        const route = useRoute();


        const state = reactive({
            posts: []
        });

        const authenticated = computed(() => store.getters.authenticated)

        const user = computed(() => store.getters.authUser)


        function addPost(post) {

            axios.post('api/posts', { body: post })
                    .then(response => {
                        state.posts.unshift(response.data.data)
                    })
                    .catch(error => console.log(error))

        }

        async function deletePost(post) {
            console.log("test", post)
            await axios.delete(`api/posts/${post.PostId}`)
                .then(response => {

                        state.posts.splice(post.PostIndex, 1)

                    })
                .catch(error => console.log(error))

        }

        onMounted( async () => {

            await axios.get('/api/timeline').then(
                response => {
                    state.posts = response.data.data
                    }

                );

        })


        return {
          state,
          addPost,
          deletePost,
          user,
          authenticated,

        }
    },
}
</script>


<style scoped>

</style>
