<template>

    <Post v-if="state.post" @delete-singlePost="deleteSinglePost" @add-comment="addComment" :post="state.post"></Post>

    <h1 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Comments</h1>

    <Comment v-if="state.post" v-for="comment in state.post.comments" :key="comment.id" :comment="comment"></Comment>

</template>


<script>
import { reactive, onMounted, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Post from '../components/Post'
import Comment from '../components/Comment'

export default {
    components: {
        Post,
        Comment
    },
    setup(props, ctx) {
        const router = useRouter()
        const route = useRoute();

        const state = reactive({
            post: null,
        });

        const postId = computed(() => route.params.postId)
        const postIndex = computed(() => route.params.index)



        async function deleteSinglePost(post) {   
            console.log(post)
            // await axios.delete(`api/posts/${post.PostId}`)
            //     .then(response => {

            //             console.log("deletetinu sible posta 3", response)
            //             // router.push({ name: 'Home', params: { singleIndex: postIndex.value } })

            //         })
            //     .catch(error => console.log(error)) 
        }

        async function addComment(commentBody) {
            await axios.post('api/comments', { body: commentBody , post_id: state.post.id })
                        .then(response => {
                            console.log(response.data)
                            state.post.comments.push(response.data.data)
                            console.log(state.post.comments)
                        })
                        .catch(error => console.log(error))
        }

        onMounted( async () => {


            const post = await axios.get(`/api/posts/${postId.value}`)
            .then(response => { 
                return response.data.data
            })

            state.post = post
        })

        return {
            state,
            postId,
            postIndex,
            deleteSinglePost,
            addComment
        }
    }
}
</script>