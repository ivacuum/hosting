<script>
import locale from '../../i18n/locale'

export default {
  data() {
    return {
      locale,
    }
  },

  computed: {
    breadcrumbs() {
      return this.$store.state.breadcrumbs
    },

    count() {
      return this.breadcrumbs.length
    }
  }
}
</script>

<template>
<div class="breadcrumbs py-2 border-bottom" v-if="count">
  <nav class="container">
    <span>
      <a :href="`${locale}/`" v-html="$root.svg.home"></a>
      <span v-html="$root.svg.angle_right"></span>
    </span>
    <span v-for="(item, i) in breadcrumbs">
      <span v-if="i + 1 < count && item.url">
        <router-link :to="`${locale}/${item.url}`" active-class="noop-active">
          {{ item.title }}
        </router-link>
        <span v-html="$root.svg.angle_right"></span>
      </span>
      <span v-else>
        {{ item.title }}
      </span>
    </span>
  </nav>
</div>
</template>
