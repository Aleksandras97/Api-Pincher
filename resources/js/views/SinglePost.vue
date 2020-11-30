<template>

    <!-- <Post v-if="state.post" :post="state.post" :index="postIndex" ></Post> -->
    <div class="p-4 border-b border-b-gray-300">
        <div class="flex justify-between ">

          <div class="flex justify-start">
            <div class="mr-4 flex-shrink-0">
                <img :src="`https://i.pravatar.cc/50?u=${ state.post.user?.email }`" alt="avatar" class="rounded">
            </div>

            <div>
              <div class="flex items-center">
                <h5 class="font-bold">{{ state.post.user?.name }} </h5>
                <h5 class="text-sm ml-2">{{state.post.created_at}}</h5>
              </div>



              <h5 class="font-semibold text-xs mb-4">@{{ state.post.user?.username }}</h5>

              <p class="text-sm">{{ state.post.body }} </p>

            </div>

          </div>

        </div>



    </div>

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
                console.log(response.data.data)
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
