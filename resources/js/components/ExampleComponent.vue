<template>
    <div>{{ user.username }}</div>
    <strong>Followers: </strong> {{ followers }}
    <button @click="followUser">Follow</button>
</template>

<script>
import {ref} from 'vue'
    export default {
        data() {
            return {
                followers: 0,
                user: {
                    id: 1,
                    username: 'Aleksandr',
                    email: 'Aleksandr@example.com',
                    isAdmin: false                    
                }
            }
        },
        methods: {
            followUser() {
                this.followers++
            }
        },
        mounted() {
            this.followUser();
        }
    }
</script>
