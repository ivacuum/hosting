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
<form class="flex mb-2 lg:mb-0" @submit.prevent="search">
  <div class="flex w-full">
    <input class="form-control rounded-r-none js-search-input" :placeholder="$t('torrents.search')" autocapitalize="none" v-model="q">
    <button class="btn btn-default -ml-px rounded-l-none" v-html="$root.svg.search"></button>
  </div>
</form>
</template>
