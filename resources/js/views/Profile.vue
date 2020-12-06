<template>

    <div class="p-12 md:p-12 text-center lg:text-left">
            <img
              :src="`https://i.pravatar.cc/3500?u=${ state.user?.email }`"
              alt="avatar"
              class="rounded-full mr-2 w-40"
              v-if="state.user">


        <h1 class="text-3xl font-bold pt-8 lg:pt-2">{{ state.user?.name }}</h1>


        <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-teal-500 opacity-25"></div>

        <div class="flex justify-between py-8">

            <p class="text-sm"><span class="font-bold">Profile Joined</span> {{ state.user?.created_at }}</p>


            <div>
              <form v-if="state.user?.id != authUser.id" @submit.prevent="follow">
                  <button v-if="state.isFollowing" type="submit" class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded-full">
                    Unfollow
                  </button>
                  <button v-else type="submit" class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded-full">
                    Follow
                  </button>
              </form>
              <button v-if="state.user?.id == authUser.id" @click="isModalOpen = true" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full">Edit Profile</button>

            </div>

        </div>

        <Modal v-if="isModalOpen" @close-modal="isModalOpen = false" >
          <template #title>
            Edit Profile
          </template>
          <template #body>
            <form action="" @submit.prevent="editProfile" enctype="multipart/form-data">
              <div class="mb-6">

                <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">Name</label>
                <input type="text" name="name" v-model="state.name" required class="border border-gray-400 p-2 w-full">
                <p class="text-red-500 text-xs mt-2">Errors</p>

              </div>

              <div class="mb-6">

                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">Email</label>
                <input type="email" name="email" v-model="state.email" required class="border border-gray-400 p-2 w-full">
                <p class="text-red-500 text-xs mt-2">Errors</p>

              </div>



              <div class="mb-6">

                <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password</label>
                <input type="password" name="password" v-model="state.password" required class="border border-gray-400 p-2 w-full">
                <p class="text-red-500 text-xs mt-2">Errors</p>

              </div>

              <div class="mb-6">

                <label for="password-confirmation" class="block mb-2 uppercase font-bold text-xs text-gray-700">Password Confirmation</label>
                <input type="password" name="password-confirmation" v-model="state.confirmPassword" required class="border border-gray-400 p-2 w-full">
                <p class="text-red-500 text-xs mt-2">Errors</p>

              </div>
              <div class="flex justify-end">

                <button @click="isModalOpen = false" class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-full mr-2">Cancel</button>
                <button type="submit" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full">submit</button>
              </div>
            </form>
          </template>
        </Modal>


    </div>

    <!-- <router-link v-for="post in state.posts" :key="post.id" :to="{ name: 'SinglePost', params: { postId: post.id } }">
        <Post :post="post"></Post>
    </router-link> -->
    <div class="md:border-t md:border-gray-500">

        <Post v-for="post in state.user?.posts" :key="post.id" :post="post"></Post>

    </div>


</template>


<script>
import { computed, onActivated, onMounted, onUpdated, reactive, ref } from 'vue'
import { useStore } from 'vuex'
import Post from '../components/Post'
import Modal from '../components/Modal'
import { useRoute, onBeforeRouteUpdate } from 'vue-router'
import axios from "axios";

export default {
    components: {
        Post,
        Modal
    },
    setup(){
      const store = useStore();
      const route = useRoute();

      const isModalOpen = ref(false)

      const state = reactive({
          user: null,
          isFollowing: '',
          name: '',
          email: '',
          password: null,
          confirmPassword: null,
          selectedFile: '',
      })


      const count = computed(() => store.state.count);

      const authUser = computed(() => store.getters.authUser)
      state.username = authUser.value.username
      state.name = authUser.value.name
      state.email = authUser.value.email
      const followingUsers = computed(() => store.getters.followingUsers)

      const name = computed(() => route.params.username)

      function follow() {
        store.dispatch('follow', state.user.username)
        if(state.isFollowing){
          state.isFollowing = ''
        }else{
          state.isFollowing = 1
        }
      }

      function onFileSelected(event){
        state.selectedFile = event.target.files[0]
      }

      function editProfile()
      {
        isModalOpen.value = false
        store.dispatch('editProfile', {
          authUser: name.value,
          name: state.name,
          email: state.email,
          password: state.password,
          confirm: state.confirmPassword,
        })

      }


      onMounted( async () => {

          await axios.get(`api/profiles/${name.value}`)
          .then(response => {
              state.user = response.data.data
          })

          const isUserFollowing = await axios.get(`api/profiles/${name.value}/isFollowing`)
          .then(response => {
              state.isFollowing = response.data
          })
      })

      onBeforeRouteUpdate(async (to, from) => {

        await axios.get(`api/profiles/${to.params.username}`)
          .then(response => {
              state.user = response.data.data
          })

      })




      return {
          state,
          name,
          count,
          authUser,
          follow,
          isModalOpen,
          editProfile,
          onFileSelected
      }

    },

}
</script>
