<script>
const hiddenFilters = ['filter', 'page', 'sd', 'sk']
const excludedFilters = ['sd', 'sk']

export default {
  props: {
    filters: {
      type: Array,
      required: true,
    },
  },

  computed: {
    activeFilters() {
      return Object
        .keys(this.$route.query)
        .filter(el => !hiddenFilters.includes(el) && typeof this.$route.query[el] !== 'undefined')
    },
  },

  methods: {
    resetAll() {
      const query = Object.assign({}, this.$route.query)

      Object
        .keys(query)
        .filter(el => !excludedFilters.includes(el))
        .forEach((el) => { query[el] = undefined })

      return { query }
    },

    resetOne(field) {
      return {
        query: {
          ...this.$route.query,
          page: undefined,
          [field]: undefined,
        }
      }
    },
  }
}
</script>

<template>
<div class="flex flex-wrap my-2" v-if="activeFilters.length">
  <router-link
    class="btn btn-default my-1 mr-1"
    :to="resetAll()"
    active-class="noop-active"
  >
    {{ $t('reset_filters') }}
  </router-link>
  <router-link
    class="btn btn-default my-1 mr-1"
    :to="resetOne(filter)"
    v-for="filter in activeFilters"
    :key="filter"
    active-class="noop-active"
  >
    {{ filter }}: {{ $route.query[filter] }}
    <span class="text-red-600" v-html="$root.svg.times"></span>
  </router-link>
</div>
</template>
