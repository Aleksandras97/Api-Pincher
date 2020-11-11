<template>
    
    <!--Main Col-->
    <!-- <div id="profile" class=" md:border md:border-gray-500 shadow-2xl bg-white lg:mx-0"> -->


        <div class="p-12 md:p-12 text-center lg:text-left">
            <!-- Image for mobile view-->
            <div class="block rounded-full shadow-xl mx-auto md:mx-0 -mt-8 h-48 w-48 bg-cover bg-center" style="background-image: url('https://i.pravatar.cc/3500')"></div>
            
            <h1 class="text-3xl font-bold pt-8 lg:pt-0">Your Name</h1>
            <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-teal-500 opacity-25"></div>
            
            <p class="pt-8 text-sm">Totally optional short description about yourself, what you do and so on.</p>

            <p>Count: {{ count }}</p>
            <button @click="increment()">Increment</button>
            <button @click="decrement()">Decrement</button>

            <div class="pt-12 pb-8">
                <button class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded-full">
                    Get In Touch
                </button> 
            </div>


        </div>


    <!-- </div> -->
    
</template>


<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
    setup(){
        const store = useStore();
        const count = computed(() => store.state.count);

        function increment() {
            store.commit("increment");
        }
        
        function decrement() {
            store.commit("decrement");
        }

        return {
            count,
            increment,
            decrement
        }
    }
}
</script>
