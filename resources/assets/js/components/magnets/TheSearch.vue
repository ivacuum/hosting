<script>
export default {
  data() {
    return {
      q: this.$route.query.q,
    }
  },

  watch: {
    $route(to) {
      // Сброс ввода при сбросе запроса
      this.q = to.query.q
    }
  },

  methods: {
    search() {
      this.$router.push({
        name: 'magnets',
        query: {
          ...this.$route.query,
          page: undefined,
          q: this.q,
        },
      })
    },
  }
}
</script>

<template>
<form class="d-flex tw-mb-2 mb-lg-0" @submit.prevent="search">
  <div class="input-group">
    <input class="form-control js-search-input" :placeholder="$t('torrents.search')" autocapitalize="none" v-model="q">
    <div class="input-group-append">
      <button class="btn btn-default" v-html="$root.svg.search"></button>
    </div>
  </div>
</form>
</template>
