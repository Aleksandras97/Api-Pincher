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

            <div class="flex justify-evenly p-2">
                <button @click="state.toggleModal = !state.toggleModal" @keydown.esc="closeCommentModal" class="btn-sm">
                    <svg class="w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                </button>

                <button class="btn-sm">
                    <svg class="w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                </button>

            </div>



        </div>

</template>

<script>
import { reactive } from 'vue';
export default {
    setup(props, { emit }){
            const state = reactive({
                toggleModal: false,
                newCommentBody: '',
            });

            function closeCommentModal() {
                state.toggleModal = false
            }

            function sumbitComment() {
                if(state.newCommentBody){
                    emit('add-comment', state.newCommentBody)
                }
                state.newCommentBody = ''
                state.toggleModal = false
            }

            return {
                state,
                closeCommentModal,
                sumbitComment
            }
    }
}
</script>
