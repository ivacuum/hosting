<script>
export default {
  props: {
    meta: {
      type: Object,
      required: true,
    },
    links: {
      type: Object,
      required: true,
    },
    classes: {
      type: String,
      default: 'tw-mt-4 text-center',
    },
  },

  computed: {
    hasMorePages() {
      return this.links.next !== null
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
<div :class="classes" v-if="links.next || meta.current_page !== 1">
  <ul class="pagination pagination-mobile m-0">
    <li class="page-item disabled" v-if="onFirstPage">
      <span class="page-link" v-html="$root.svg.chevron_left"></span>
    </li>
    <li class="page-item" v-else>
      <router-link
        class="page-link"
        :to="prevPage()"
        rel="prev"
        v-html="$root.svg.chevron_left"
      />
    </li>

    <li class="page-item" v-if="hasMorePages">
      <router-link
        class="page-link"
        :to="nextPage()"
        rel="next"
        v-html="$root.svg.chevron_right"
      />
    </li>
    <li class="page-item disabled" v-else>
      <span class="page-link" v-html="$root.svg.chevron_right"></span>
    </li>
  </ul>
</div>
</template>
