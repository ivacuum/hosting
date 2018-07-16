<script>
export default {
  props: {
    field: {
      type: String,
      required: true,
    },
    default: {
      type: Boolean,
      default: false,
    },
    defaultSortDir: {
      type: String,
      default: 'desc',
    },
  },

  computed: {
    active() {
      return this.$route.query.sk === this.field
        || (this.$route.query.sk === undefined && this.default)
    },

    newSortDir() {
      if (this.active) {
        return this.sortDir === 'desc' ? 'asc' : 'desc'
      }

      return this.defaultSortDir
    },

    sortDir() {
      return this.$route.query.sd || this.defaultSortDir
    },
  },

  methods: {
    query() {
      return {
        query: {
          ...this.$route.query,
          sk: this.field,
          sd: this.newSortDir,
          page: undefined,
        }
      }
    }
  }
}
</script>

<template>
<router-link :to="query()">
  <slot/>
  <template v-if="active">
    <span v-html="$root.svg.angle_down" v-if="sortDir === 'desc'"></span>
    <span v-html="$root.svg.angle_up" v-if="sortDir === 'asc'"></span>
  </template>
</router-link>
</template>
