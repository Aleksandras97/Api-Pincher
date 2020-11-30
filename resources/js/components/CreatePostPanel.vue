<template>

    <div class="px-8 py-4 border-b border-gray-500">

        <form action="" @submit.prevent="sumbitPost" :class="{'text-red-500': newPostCharacterCount > 180}">
            <textarea id="newPost" class="w-full" placeholder="Post!" v-model="state.newPostBody" />
            <hr class="my-4">

            <footer class="flex justify-between">
              <div class="flex items-center">

                <img :src="`https://i.pravatar.cc/200?u=${ user.email }`" alt="avatar" class="rounded-full m-1 w-10">
                <h1 class="block font-bold text-gray-700 text-xl"> {{ user.name}} </h1>

              </div>

                <div class="flex items-center">

                    <p class="block pr-2">({{ newPostCharacterCount }}/180)</p>

                    <button type="submit" :disabled='newPostCharacterCount > 180' :class="{'opacity-50': newPostCharacterCount > 180 }" class="btn block hover:bg-teal-900">Post!</button>

                </div>


            </footer>

        </form>



    </div>
</template>

<script>
import { reactive, computed } from 'vue';
import { useStore } from 'vuex';

export default {
    setup(props, context) {
        const store = useStore();
        const state = reactive({
            newPostBody: '',
            post: {},
        });

        const newPostCharacterCount = computed(() => state.newPostBody.length);

        const user = computed(() => store.getters.authUser)


        function sumbitPost() {
            if(state.newPostBody) {
                context.emit('add-post', state.newPostBody)
                state.newPostBody = ''
            }
        }


        return {
            state,
            newPostCharacterCount,
            sumbitPost,
            user
        }
    },
}
</script>
