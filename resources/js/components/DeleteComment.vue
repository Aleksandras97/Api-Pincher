<template>

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
                    @click="deleteComment"
                    class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                    role="menuitem">Delete</a>
                </div>
            </div>
        </div>
    </transition>
</div>

</template>

<script>
import { reactive } from 'vue'
export default {
  setup(props,{emit}) {
    const state = reactive({
      isOpen: false,
    })

    function deleteComment(){
      emit('delete-comment')
      state.isOpen = false
    }

    return {
      state,
      deleteComment,
    }
  }
}
</script>
