<script>
import RadicalList from '../../components/japanese/RadicalList.vue'

export default {
  components: { RadicalList },

  created() {
    document.title = this.$i18n.t('japanese.radicals')
  }
}
</script>

<template>
<div>
  <h1 class="h2">{{ $t('japanese.radicals') }}</h1>
  <radical-list/>
</div>
</template>
