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
  <div class="tw-flex tw-items-center tw-flex-wrap tw-mb-2 tw--mt-2">
    <h3 class="tw-mb-1 tw-mr-4">
      {{ $t(`${plural}.index`) }}
      <small class="text-muted tw-whitespace-no-wrap">{{ meta.total }}</small>
    </h3>
    <router-link
      class="btn btn-success tw-my-1 tw-mr-2"
      :to="meta.new_url"
      v-if="meta.new_url"
    >
      {{ $t(`${plural}.create`) }}
    </router-link>
    <form
      class="tw-my-1 tw-mr-2"
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
