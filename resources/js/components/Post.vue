<template>

    <div class="flex p-4 border-b border-b-gray-300">
        <div class="mr-4 flex-shrink-0">
            <img :src="`https://i.pravatar.cc/50?u=${ post.user.email }`" alt="avatar" class="rounded-full">
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

            // function getImgUrl(pet) {
            //     return images('https://i.pravatar.cc/50?u=' + post.user.email)
            // }

            onMounted(() => {
                // console.log("post props" , post)
            })

            return {
                // getImgUrl
            }
        }
    }
</script>