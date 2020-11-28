<template>
    <div class="p-4 border-b border-b-gray-300">
      <div class="flex justify-between ">
        <div class="flex justify-start">
              <div class="mr-4 flex-shrink-0">
                  <img :src="`https://i.pravatar.cc/50?u=${ comment.user.email }`" alt="avatar" class="rounded-full">
              </div>
              <div>
                  <div class="flex items-center">
                    <h5 class="font-bold">{{ comment.user.name }} </h5>
                    <h5 class="text-sm ml-2">{{comment.created_at}}</h5>
                  </div>

                  <p class="text-sm"> {{ comment.body }}</p>
              </div>
        </div>

          <DeleteComment  @delete-comment="deleteComment" />

      </div>
    </div>
</template>

<script>
import DeleteComment from './DeleteComment'
export default {
  components: {
      DeleteComment
  },
  props: {
    comment: {
        type: Object,
        required: true,
    },
    index: {
        type: Number,
        required: true,
    },

  },
  setup(props, {emit}){

    function deleteComment(){
      emit('delete-comment', { CommentId: props.comment.id, CommentIndex: props.index })
    }

    return {
      deleteComment,
    }
  }
}
</script>
