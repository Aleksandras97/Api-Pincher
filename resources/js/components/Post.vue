<template>

    <div class="p-4 border-b border-b-gray-300">
        <div class="flex justify-between ">

          <div class="flex justify-start">
            <router-link class="mr-4 flex-shrink-0" :to="{ name: 'Profile', params: { username: post.user?.username } }">
                <img :src="`https://i.pravatar.cc/50?u=${ post.user?.email }`" alt="avatar" class="rounded">
            </router-link>

            <div>
              <div class="flex items-center">
                <h5 class="font-bold">{{ post.user?.name }} </h5>
                <h5 class="text-sm ml-2">{{post.created_at}}</h5>
              </div>



                <router-link  :to="{ name: 'Profile', params: { username: post.user?.username } }">
                    <h5 class="font-semibold text-xs mb-4">@{{ post.user?.username }}</h5>
                </router-link>

                <p class="text-sm">{{ post.body }} </p>

            </div>

          </div>

          <DeletePost  @delete-post="deletePost" />

        </div>



    </div>



</template>

<script>
import { onMounted, reactive } from 'vue'
import CommentModal from './CommentModal'
import DeletePost from './DeletePost'
import { useStore } from 'vuex'
    export default {
        components: {
            CommentModal,
            DeletePost
        },
        props: {
            post: {
                type: Object,
                required: true,
            },
            index: {
                type: Number,
                required: false,
            }
        },
        emits: ['delete-post', 'delete-singlePost'],
        setup(props, context){
            const store = useStore();

            const state = reactive({
              postIndex: props.index
            });

            function deletePost(){
              store.dispatch('deletePost', { PostId: props.post.id, PostIndex: props.index })
            }

            onMounted(() => {
                // console.log("post props" , post)
            })

            return {
                state,
                deletePost,
            }
        }
    }
</script>

<style scoped>

</style>
