<template>

    <Post v-if="state.post" :post="state.post"></Post>

    <h1 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Comments</h1>

    <Comment v-for="comment in state.post?.comments" :key="comment.id" :comment="comment"></Comment>

</template>


<script>
import { reactive, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';
import Post from '../components/Post'
import Comment from '../components/Comment'

export default {
    components: {
        Post,
        Comment
    },
    setup(props, ctx) {
        const route = useRoute();
        const postId = computed(() => route.params.postId)


        const state = reactive({
            post: null,
        });

        onMounted( async () => {


            const post = await axios.get(`/api/posts/${postId.value}`)
            .then(response => { 
                return response.data.data
            })

            state.post = post
            console.log(post)



            // console.log(postId.value)
            // const {data: post} = await axios.get(`/api/posts/${postId.value}`);

            // if(post){
            //     state.post = post
            //     console.log("Single post", state.post.user)
            


            // }

            
            


        })

        // onMounted(() => console.log(state.user.comments[0].user.username))

        return {
            state,
            postId
        }
    }
}
</script>