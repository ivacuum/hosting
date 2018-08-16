<script>
import RadicalsList from '../../components/japanese/RadicalsList.vue'

export default {
  components: { RadicalsList },

  created() {
    document.title = this.$i18n.t('japanese.radicals')
  }
}
</script>

<template>
<div>
  <h1 class="h2">{{ $t('japanese.radicals') }}</h1>
  <radicals-list/>
</div>
</template>
