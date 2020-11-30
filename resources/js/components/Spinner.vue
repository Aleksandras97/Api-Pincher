<template>
  <div>
     <flower-spinner
      :animation-duration="2500"
      :size="70"
      :color="'#F40374'"
    />
  </div>
</template>

<script>
import {FlowerSpinner} from 'epic-spinners'
export default {
  components: {
    FlowerSpinner
  }
}
</script>

<style scoped>

</style>
