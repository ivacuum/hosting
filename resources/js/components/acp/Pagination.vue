<script>
export default {
  props: {
    meta: {
      type: Object,
      required: true,
    },
    classes: {
      type: String,
      default: 'mt-4 text-center',
    },
  },

  computed: {
    hasMorePages() {
      return this.meta.last_page > this.meta.current_page
    },

    onFirstPage() {
      return this.meta.current_page === 1
    }
  },

  mounted() {
    Mousetrap.bind(['ctrl+left', 'alt+left'], () => {
      if (!this.onFirstPage) this.$router.push(this.prevPage())
    })

    Mousetrap.bind(['ctrl+right', 'alt+right'], () => {
      if (this.hasMorePages) this.$router.push(this.nextPage())
    })
  },

  destroyed() {
    Mousetrap.unbind(['ctrl+left', 'alt+left', 'ctrl+right', 'alt+right'])
  },

  methods: {
    url(page) {
      return { query: { ...this.$route.query, page } }
    },

    nextPage() {
      return this.url(this.meta.current_page + 1)
    },

    prevPage() {
      return this.url(this.meta.current_page - 1)
    }
  }
}
</script>

<template>
<div :class="classes" v-if="meta.last_page > 1">
  <nav class="flex items-center justify-between w-full">
    <div v-if="!onFirstPage">
      <router-link
        class="btn btn-default"
        :to="prevPage()"
        rel="prev"
        v-html="$root.svg.chevron_left"
      />
    </div>

    <div class="w-4"></div>

    <div v-if="hasMorePages">
      <router-link
        class="btn btn-default"
        :to="nextPage()"
        rel="next"
        v-html="$root.svg.chevron_right"
      />
    </div>
  </nav>
</div>
</template>
