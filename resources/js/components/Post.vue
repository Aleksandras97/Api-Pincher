<template>

    <div class="p-4 border-b border-b-gray-300">
        <div class="flex justify-between ">

            <div class="flex justify-start">
                <div class="mr-4 flex-shrink-0">
                    <img :src="`https://i.pravatar.cc/50?u=${ post.user.email }`" alt="avatar" class="rounded">
                </div>
                
                <div>
                    <h5 class="font-bold">{{ post.user.name }}</h5>

                    <router-link  :to="{ name: 'Profile', params: { username: post.user.username } }">
                        <h5 class="font-semibold text-xs mb-4">@{{ post.user.username }}</h5>
                    </router-link>
                    
                    <router-link  :to="{ name: 'SinglePost', params: { postId: post.id, index: index } }">
                        <p class="text-sm"> {{ post.body }}  Id:{{ post.id }}</p>
                    </router-link>
                    
                </div>

            </div>
            <div>
                <div>
                    <span class="bg-white">
                        <!-- <button @click="state.isOpen = !state.isOpen" class="btn-sm text-xl hover:bg-gray-300 focus:outline-none active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150">
                            ...
                        </button> -->
                        <button @click="state.isOpen = !state.isOpen" class="btn-sm">
                            <svg class="w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                    </span>

                </div>


                <transition
                    enter-active-class="transition ease-out duration-100 transform"
                    enter-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75 transform"
                    leave-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div v-show="state.isOpen" class="origin-top-right absolute mt-2 w-56 rounded-md shadow-lg">
                        <div class="rounded-md bg-white shadow-xs">
                        
                            <div class="border-t border-gray-100"></div>
                            <div class="py-1">
                                <a href="#"
                                @click="deletePost"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" 
                                role="menuitem">Delete</a>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>

        <div class="flex justify-evenly p-2">

            <button @click="state.toggleModal = !state.toggleModal" @keydown.esc="closeCommentModal" class="btn-sm">
                <svg class="w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
            </button>

            <button class="btn-sm">
                <svg class="w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
            </button>

        </div>

        <CommentModal :postId="post.id" @add-comment="addComment" />

        

    </div>
            


</template>

<script>
import { onMounted, reactive } from 'vue'
import CommentModal from './CommentModal'
    export default {
        components: {
            CommentModal
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

            const state = reactive({
                isOpen: false,
                toggleModal: false,
            });
            
            function deletePost(){
                if(props.index){
                    context.emit('delete-post', { PostId: props.post.id, PostIndex: props.index })
                    state.isOpen = false
                    console.log("one")
                } else {
                    context.emit('delete-singlePost', { PostId: props.post.id})
                    state.isOpen = false
                    console.log("two")
                }
            }

            function addComment(commentBody) {
                context.emit('add-comment', commentBody)
            }

            onMounted(() => {
                // console.log("post props" , post)
            })

            return {
                state,
                deletePost,
                addComment,
            }
        }
    }
</script>

<style scoped>

</style>