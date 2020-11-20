<template>
    <div>
            <!--Modal-->
            <teleport  to="#modals">
                <div v-if="state.toggleModal"  class="fixed w-full h-full top-0 left-0 flex items-center justify-center">
                    
                    
                    <div class="bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    
                        <div @click="state.toggleModal = !state.toggleModal" class="absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                            <span class="text-sm">(Esc)</span>
                        </div>

                        <!-- Add margin if you want to see some of the overlay behind the modal-->
                        <div class="modal-content py-4 text-left px-6">
                            <!--Title-->
                            <div class="flex justify-between pb-3">
                                <p class="text-2xl font-bold">Comment</p>
                                <div @click="state.toggleModal = !state.toggleModal" class="cursor-pointer z-50">
                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!--Body-->
                            <p class="text-sm font-semibold py-1">Write comment here</p>

                            <form action="" @submit.prevent="sumbitComment">
                                <textarea id="newPost" class="w-full focus:outline-none" placeholder="Comment!" v-model="state.newCommentBody" />
                                <hr class="my-4">

                                <footer class="flex justify-end">

                                    <!--Footer-->
                                    <div class="flex justify-end pt-2">
                                        <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Reply</button>
                                        <button @click="state.toggleModal = !state.toggleModal" class="px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                                    </div>
                                    
                                    
                                </footer>


                            </form>

                            
                            
                        </div>
                    </div>
                    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                </div>
            </teleport>
            
        </div>
        
</template>

<script>
import { reactive } from 'vue';
export default {
    props: {
            postId: {
                type: Number,
                required: true,
            }
    },
    emits: ['add-comment'],
    setup(props, { emit }){
            const state = reactive({
                toggleModal: false,
                newCommentBody: '',
            });

            function closeCommentModal() {
                state.toggleModal = false
            }

            function sumbitComment() {
                console.log(props.postId)
                if(state.newCommentBody){
                    emit('add-comment', state.newCommentBody)
                    

                }
                state.newCommentBody = ''
            }

            return {
                state,
                closeCommentModal,
                sumbitComment
            }
        }
}
</script>