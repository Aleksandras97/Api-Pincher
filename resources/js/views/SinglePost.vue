<template>

    <Post v-if="state.post" :post="state.post" :index="postIndex" ></Post>

    <CommentModal @add-comment="addComment" />

    <h1 class="font-bold text-gray-700 bg-gray-300 text-xl py-2 px-4 pb-2 border-b border-gray-500">Comments</h1>

    <Comment v-for="(comment, index) in state.post?.comments" :key="comment.id" :index="index" :comment="comment" @delete-comment="deleteComment" ></Comment>

</template>


<script>
import { reactive, onMounted, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Post from '../components/Post'
import Comment from '../components/Comment'
import CommentModal from '../components/CommentModal'

export default {
    components: {
        Post,
        Comment,
        CommentModal,
    },
    setup(props, ctx) {
        const router = useRouter()
        const route = useRoute();

        const state = reactive({
            post: {},
        });


        const postId = computed(() => route.params.postId)

        const postIndex = computed(() => route.params.index)

        async function addComment(commentBody) {
            await axios.post('api/comments', { body: commentBody , post_id: state.post.id })
                        .then(response => {
                            console.log(response.data)
                            state.post.comments.push(response.data.data)
                            console.log(state.post.comments)
                        })
                        .catch(error => console.log(error))
        }

        async function deleteComment(comment) {
            await axios.delete(`api/comments/${comment.CommentId}`)
            state.post.comments.splice(comment.CommentIndex, 1)
        }

        onMounted( async () => {


            state.post = await axios.get(`/api/posts/${postId.value}`)
            .then(response => {
                return response.data.data
            })
        })

        return {
            state,
            postId,
            postIndex,
            addComment,
            deleteComment
        }
    }
}
</script>
