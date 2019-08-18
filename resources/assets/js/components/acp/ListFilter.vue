<script>
export default {
  props: {
    field: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    values: {
      type: Array,
      required: true,
    },
  },

  computed: {
    current() {
      return typeof this.$route.query[this.field] !== 'undefined'
        ? this.values.find((el) => String(el.value) === String(this.$route.query[this.field])).label
        : 'Все'
    },
  },

  methods: {
    applyFilter(value) {
      return {
        query: {
          ...this.$route.query,
          page: undefined,
          [this.field]: value,
        }
      }
    },

    clearFilter() {
      return this.applyFilter(undefined)
    }
  }
}
</script>

<template>
<div class="dropdown tw-my-1 tw-mr-2">
  <a class="btn btn-default dropdown-toggle" href="#" data-toggle="dropdown">
    <span class="text-muted" v-html="$root.svg.filter"></span>
    {{ title }}: {{ current }}
  </a>
  <div class="dropdown-menu">
    <router-link class="dropdown-item" active-class="noop-active" :to="clearFilter()">Все</router-link>
    <div class="dropdown-divider"></div>
    <router-link
      class="dropdown-item"
      active-class="noop-active"
      :to="applyFilter(row.value)"
      v-for="row in values"
      :key="row.value"
    >
      {{ row.label }}
    </router-link>
  </div>
</div>
</template>
