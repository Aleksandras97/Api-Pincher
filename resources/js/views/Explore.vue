<template>
  <h1 class="text-4xl p-3">Explore</h1>

  <router-link v-for="user in state.users" :key="user.id" :to="{ name: 'Profile', params: { username: user.username } }" class="flex justify-start items-center rounded shadow-md border mx-2 my-4 hover:bg-gray-200">

      <img :src="`https://i.pravatar.cc/100?u=${ user.email }`" alt="avatar" class="rounded w-20 border">

      <h4 class="font-bold text-gray-700 text-xl pl-8">@{{ user.username }}</h4>

  </router-link>

  <nav>
    <ul class="flex justify-between w-auto p-4 mx-auto">
      <li>
        <button
          :disabled='!state.pagination.prev_page_url'
          :class="{'opacity-50': !state.pagination.prev_page_url }"
          class="btn-ex block hover:bg-blue-400"
          @click="getUsers(state.pagination.prev_page_url)">
          Perv Page
        </button>
      </li>
      <li>
        <button disabled class="btn-ex block hover:bg-blue-400">Page {{ state.pagination.current_page }} out of {{ state.pagination.last_page }}</button>
      </li>
      <li>
      <button
        :disabled='!state.pagination.next_page_url'
        :class="{'opacity-50': !state.pagination.next_page_url }"
        class="btn-ex block hover:bg-blue-400"
        @click="getUsers(state.pagination.next_page_url)">
        Next Page
      </button>
      </li>
    </ul>
  </nav>

</template>

<script>
import { onMounted, reactive } from 'vue'
  export default {
    setup(){
      const state = reactive({
        users: [],
        pagination: {},
        loading: true,
      })



      async function getUsers(page_url){
        page_url = page_url || 'api/explore'

        await axios
            .get(page_url)
            .then(response => {
              state.users = response.data.data
              makePagination(response.data)
            })
            .catch(error => console.log(error))
            .finally(()=> state.loading = false)
      }

      function makePagination(data){
        let pagination = {
          current_page: data.current_page,
          last_page: data.last_page,
          prev_page_url: data.prev_page_url,
          next_page_url: data.next_page_url,
        }
        state.pagination = pagination
      }

      onMounted( () => {
        getUsers()
      })


      return {
        state,
        getUsers,
      }
    }
  }
</script>
