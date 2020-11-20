<template>

    <div class="px-8 py-4 border-b border-gray-500">

        <form action="" @submit.prevent="sumbitPost" :class="{'text-red-500': newPostCharacterCount > 180}">
            <textarea id="newPost" class="w-full" placeholder="Post!" v-model="state.newPostBody" />
            <hr class="my-4">

            <footer class="flex justify-between">
                <img :src="`https://i.pravatar.cc/50?u=${ user.email }`" alt="avatar" class="rounded-full">

                <div class="flex">

                    <p class="block">({{ newPostCharacterCount }}/200)</p>
                    
                    <button type="submit" :disabled='newPostCharacterCount > 180' :class="{'opacity-50': newPostCharacterCount > 180 }" class="btn block hover:bg-teal-900">Punch!</button>

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