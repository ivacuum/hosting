<script>
import TheSearch from '../../components/japanese/TheSearch.vue'

export default {
  components: { TheSearch },
}
</script>

<template>
<div class="antialiased">
  <the-search/>
  <router-view/>
</div>
</template>
