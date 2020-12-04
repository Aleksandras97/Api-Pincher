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
    }
}
</script>
