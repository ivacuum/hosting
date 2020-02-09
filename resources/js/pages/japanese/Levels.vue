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
  <div class="flex flex-wrap items-center">
    <router-link
      class="flex bg-gray-600 hover:bg-gray-700 text-white hover:text-gray-100 px-2 text-lg font-bold rounded mr-2 mb-2"
      :to="{ name: 'wk.level', params: { level }}"
      v-for="level in 60"
      :key="level"
    >
      {{ level }}
    </router-link>
  </div>
</div>
</template>
