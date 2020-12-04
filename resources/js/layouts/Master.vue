<template>
    <div class="grid md:grid-cols-3 min-h-screen">

        <div>
            <Navbar></Navbar>
        </div>

        <main class=" px-4 md:col-span-2" style="max-width: 650px">

            <div class="md:border md:border-gray-500 shadow-2xl bg-white lg:mx-0">

                <router-view></router-view>

            </div>

        </main>
    </div>

    <Footer />
</template>

<script>
import { onMounted, computed, reactive } from 'vue'
import { useStore } from 'vuex';
import Navbar from '../components/Navbar'
import Footer from '../components/Footer'
export default {
    components: {
        Navbar,
        Footer
    },
    setup(){
        const store = useStore();
        const state = reactive({
            user: null,
        });

        const authenticated = computed(() => store.getters.authenticated)


        return {
            state,
            authenticated
        }
    }
}
</script>
