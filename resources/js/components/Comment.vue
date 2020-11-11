<template>
    <div class="flex p-4 border-b border-b-gray-300">
        <div class="mr-4 flex-shrink-0">
            <img src="https://i.pravatar.cc/50" alt="avatar" class="rounded-full">
        </div>
        <div>
            <h5 class="font-bold mb-4"> {{ comment.user.name }}</h5>
            
            <p class="text-sm"> {{ comment.body }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
            comment: {
                type: Object,
                required: true
            }
        }
}
</script>