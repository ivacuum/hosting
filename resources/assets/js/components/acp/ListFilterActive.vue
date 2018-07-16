<script>
export default {
  props: {
    filters: {
      type: Array,
      required: true,
    },
  },

  computed: {
    activeFilters() {
      return this.filters.filter((el) => typeof this.$route.query[el.field] !== 'undefined')
    },
  },

  methods: {
    resetAll() {
      const filters = this.filters.reduce((result, filter) => {
        result[filter.field] = undefined

        return result
      }, {})

      return { query: { ...this.$route.query, ...filters } }
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
<div class="d-flex flex-wrap my-2" v-if="activeFilters.length">
  <router-link
    class="btn btn-default my-1 mr-1"
    :to="resetAll()"
    active-class="noop-active"
  >
    {{ $t('reset_filters') }}
  </router-link>
  <router-link
    class="btn btn-default my-1 mr-1"
    :to="resetOne(filter.field)"
    v-for="filter in activeFilters"
    :key="filter.field"
    active-class="noop-active"
  >
    {{ filter.field }}: {{ $route.query[filter.field] }}
    <span class="text-danger" v-html="$root.svg.times"></span>
  </router-link>
</div>
</template>
