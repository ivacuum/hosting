<script>
export default {
  created() {
    document.title = this.$i18n.t('japanese.levels')
  }
}
</script>

<template>
<div>
  <h1 class="h2">{{ $t('japanese.levels') }}</h1>
  <div class="d-flex flex-wrap align-items-center">
    <router-link
      class="badge badge-secondary f16 mr-2 mb-2"
      :to="{ name: 'wk.level', params: { level }}"
      v-for="level in 60"
      :key="level"
    >
      {{ level }}
    </router-link>
  </div>
</div>
</template>
