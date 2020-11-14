<template>

    <Timeline></Timeline>



</template>


<script>
import Timeline from '../components/Timeline';
import Navbar from '../components/Navbar.vue';
import { onMounted, reactive } from 'vue';
import { useStore } from 'vuex';

export default {
    components: {
        Timeline,
        Navbar
    },
    setup(){
        const store = useStore();
        const state = reactive({
            user: null,
        })
        
        // onMounted( async () => {
        //     axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.state.token

        //     const user = await axios.get(`/api/logedinUser`)
        //         .then(response => {
        //             return response.data.data
        //         })

        //     store.dispatch('retrieveLogedinUser', user);
        //     state.user = user
        //     console.log(state.user.username)
        // })
        
        return {
            state
        }
    }
}
</script>
