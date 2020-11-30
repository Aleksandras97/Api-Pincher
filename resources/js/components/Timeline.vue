<template>


        <CreatePostPanel @add-post="addPost"></CreatePostPanel>

        <h4 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Latests Posts</h4>

        <!-- posts -->
        <transition-group name="fade" enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">

            <router-link v-if="state.posts" v-for="(post, index) in state.posts" :key="post.id" :to="{ name: 'SinglePost', params: { postId: post.id } }">
                <Post :post="post" :index="index" ></Post>
            </router-link>

        </transition-group>
        <div v-if="state.posts < 1">
          <h1 class="text-lg px-4 py-2 font-bold text-center">No posts yet. Make sure to post something!</h1>
        </div>




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
            posts: computed(() => store.getters.timeline)
        });

        const authenticated = computed(() => store.getters.authenticated)

        const user = computed(() => store.getters.authUser)



        function addPost(post) {
          store.dispatch('addPost', post)
        }

        onMounted(() => {
            state.posts = computed(() => store.getters.timeline)
        })


        return {
          state,
          addPost,
          user,
          authenticated,
        }
    },
}
</script>


<style scoped>

</style>
