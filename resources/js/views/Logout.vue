<template>
    
</template>

<script>
import { onMounted } from 'vue';
import { useStore } from 'vuex'
import { useRouter } from 'vue-router';
export default {
    setup(){
        const store = useStore();
        const router = useRouter();

        onMounted(() => {
            store.dispatch('destroyToken')
                .then(responce => {
                        router.push({ name: 'Home'})
                    })
        })

        return {

        }
    }
}
</script>