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
  <div class="tw-flex tw-flex-wrap tw-items-center">
    <router-link
      class="tw-flex tw-bg-gray-600 hover:tw-bg-gray-700 tw-text-white hover:tw-text-gray-100 tw-px-2 tw-text-lg tw-font-bold tw-rounded tw-mr-2 tw-mb-2"
      :to="{ name: 'wk.level', params: { level }}"
      v-for="level in 60"
      :key="level"
    >
      {{ level }}
    </router-link>
  </div>
</div>
</template>
