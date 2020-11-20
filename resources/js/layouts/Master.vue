<template>
    <div class="grid md:grid-cols-3"> 

        <div>
            <Navbar></Navbar>
        </div>
        
        
        <main class=" px-4 md:col-span-2" style="max-width: 650px">

            <div class="p-3 flex justify-center md:justify-end md:border-r md:border-l  border-gray-500">
             
             
                Hello
                
                
            </div>

            <div class="md:border md:border-gray-500 shadow-2xl bg-white lg:mx-0">

                

                <router-view></router-view>
                
            </div>
        


        </main>
            
    </div> 
</template>

<script>
import { onMounted, computed, reactive } from 'vue'
import { useStore } from 'vuex';
import Navbar from '../components/Navbar'
export default {
    components: {
        Navbar
    },
    setup(){
        const store = useStore();
        const state = reactive({
            user: null,
        });
        // console.log(store.getters)
        
        
        return {
            state
        }
    }
}
</script>