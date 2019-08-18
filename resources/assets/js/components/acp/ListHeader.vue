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

  data() {
    return {
      q: this.$route.query.q,
    }
  },

  watch: {
    $route(to) {
      // Сброс ввода при сбросе фильтра
      this.q = to.query.q
    }
  },
}
</script>

<template>
<div>
  <div class="d-flex align-items-center flex-wrap mb-2 mt-n2">
    <h3 class="tw-mb-1 mr-3">
      {{ $t(`${plural}.index`) }}
      <small class="text-muted tw-whitespace-no-wrap">{{ meta.total }}</small>
    </h3>
    <router-link
      class="btn btn-success my-1 mr-2"
      :to="meta.new_url"
      v-if="meta.new_url"
    >
      {{ $t(`${plural}.create`) }}
    </router-link>
    <form
      class="my-1 mr-2"
      @submit.prevent="$emit('search', q)"
      v-if="!!$listeners.search"
    >
      <input
        class="form-control js-search-input"
        :placeholder="$t('model.q_placeholder')"
        autocapitalize="none"
        v-model="q"
      >
    </form>
    <list-filter
      v-bind="filter"
      v-for="filter in filters"
      :key="filter.field"
    />
  </div>

  <list-filter-active :filters="filters"/>
</div>
</template>
