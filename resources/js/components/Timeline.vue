<template>
    <h4 class="font-bold text-gray-700 text-xl my-6 pb-2 border-b border-gray-200">Latests Posts</h4>

    <div class="border border-gray-300 rounded-lg">

        <!-- posts -->
        <Post></Post>

        <Post></Post>

        <Post></Post>

        <Post></Post>

        
    </div>
</template>

<script>
import Post from "./Post"

export default {
    components: {
        Post
    }
}
</script>