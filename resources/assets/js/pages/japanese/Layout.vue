<script>
import TheSearch from '../../components/japanese/TheSearch.vue'

export default {
  components: { TheSearch },
}
</script>

<template>
<div class="font-smooth">
  <the-search/>
  <router-view/>
</div>
</template>
