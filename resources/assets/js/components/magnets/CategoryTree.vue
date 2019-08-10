<script>
import { mapState } from 'vuex'

export default {
  computed: mapState({
    tree: state => state.magnets.categoryTree,
    stats: state => state.magnets.categoryStats,
  }),
}
</script>

<template>
<nav>
  <div class="mb-4" v-for="(category, id) in tree" :key="id">
    <h4>
      <mark v-if="$route.query.category_id === id">{{ category.title }}</mark>
      <router-link class="visited" :to="{ query: { category_id: id }}" v-else>{{ category.title }}</router-link>
    </h4>
    <div v-for="(child, childId) in category.children" :key="childId">
      <mark v-if="$route.query.category_id === childId">{{ child.title }}</mark>
      <router-link class="visited" :to="{ query: { category_id: childId }}" v-else>{{ child.title }}</router-link>
      <span class="text-muted f13">{{ stats[childId] }}</span>
    </div>
  </div>
</nav>
</template>
