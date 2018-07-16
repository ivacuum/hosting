<script>
import ListFilter from './ListFilter.vue'
import ListFilterActive from './ListFilterActive.vue'

export default {
  components: {
    ListFilter,
    ListFilterActive,
  },

  props: {
    meta: {
      type: Object,
      required: true,
    },
    plural: {
      type: String,
      required: true,
    },
    filters: {
      type: Array,
      default: [],
    },
  },
}
</script>

<template>
<div>
  <div class="d-flex align-items-center flex-wrap mb-2 mt-n2">
    <h3 class="mb-1 mr-3">
      {{ $t(`${plural}.index`) }}
      <small class="text-muted text-nowrap">{{ meta.total }}</small>
    </h3>
    <router-link
      class="btn btn-success my-1 mr-2"
      :to="meta.new_url"
      v-if="meta.new_url"
    >
      {{ $t(`${plural}.create`) }}
    </router-link>
    <list-filter
      v-bind="filter"
      v-for="filter in filters"
      :key="filter.field"
    />
  </div>

  <list-filter-active :filters="filters"/>
</div>
</template>
