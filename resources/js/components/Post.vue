<template>

    <div class="flex p-4 border-b border-b-gray-300">
        <div class="mr-4 flex-shrink-0">
            <img src="https://i.pravatar.cc/50" alt="avatar" class="rounded-full">
        </div>
        <div>
            <h5 class="font-bold">{{ post.user.name }}</h5>
            <h5 class="font-semibold text-xs mb-4">{{ post.user.email }}</h5>
            
            <p class="text-sm"> {{ post.body }} </p>
        </div>
    </div>

</template>

<script>
import { onMounted } from 'vue'
    export default {
        props: {
            post: {
                type: Object,
                required: true
            }
        },
        setup(){

            onMounted(() => {
                // console.log("post props" , post)
            })
        }
    }
</script>