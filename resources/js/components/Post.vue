<template>

    <div class="flex justify-between p-4 border-b border-b-gray-300">
        <div class="flex justify-start">
            <div class="mr-4 flex-shrink-0">
                <img :src="`https://i.pravatar.cc/50?u=${ post.user.email }`" alt="avatar" class="rounded">
            </div>
            
            <div>
                <h5 class="font-bold">{{ post.user.name }}</h5>

                <router-link  :to="{ name: 'Profile', params: { username: post.user.username } }">
                    <h5 class="font-semibold text-xs mb-4">@{{ post.user.username }}</h5>
                </router-link>
                
                <router-link  :to="{ name: 'SinglePost', params: { postId: post.id } }">
                    <p class="text-sm"> {{ post.body }} </p>
                </router-link>
                
            </div>

        </div>
        <div>
            <div>
                <span class="bg-white">
                    <button @click="state.isOpen = !state.isOpen" class="btn-sm text-xl hover:bg-gray-300 focus:outline-none active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150">
                        ...
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

</template>

<script>
import { onMounted, reactive } from 'vue'
    export default {
        props: {
            post: {
                type: Object,
                required: true,
            },
            index: {
                type: Number,
                required: true,
            }
        },
        setup(props, context){

            const state = reactive({
                isOpen: false,
            });
            
            function deletePost(){
                context.emit('delete-post', { PostId: props.post.id, PostIndex: props.index })
                state.isOpen = false
            }

            onMounted(() => {
                // console.log("post props" , post)
            })

            return {
                state,
                deletePost
            }
        }
    }
</script>