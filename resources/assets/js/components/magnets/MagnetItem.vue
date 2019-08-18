<script>
export default {
  props: {
    magnet: {
      type: Object,
      required: true,
    },
    category: {
      type: Object,
      required: true,
    }
  },

  methods: {
    download(magnet) {
      this.$store.dispatch('clickMagnet', magnet)
    },
  }
}
</script>

<template>
<div
  class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-start torrents-list-container js-torrents-views-observer"
  :data-id="magnet.id"
  :key="magnet.id"
>
  <div
    class="flex-shrink-0 order-1 order-md-0 torrents-list-icon torrent-icon"
    :title="category.title"
    v-html="$root.svg[category.icon]"
  ></div>
  <router-link class="flex-grow-1 tw-mb-2 mb-md-0 mr-md-3 visited" :to="{ name: 'magnet', params: { id: magnet.id }}">
    <torrent-title :title="magnet.title" hide_brackets=""/>
  </router-link>
  <a
    class="flex-shrink-0 pr-2 torrents-list-magnet text-center text-md-left tw-whitespace-no-wrap"
    :href="magnet.magnet"
    :title="$t('torrents.download')"
    @click="download(magnet)"
  >
    <span v-html="$root.svg.magnet"></span>
    <span v-if="magnet.clicks > 0">{{ magnet.clicks }}</span>
  </a>
  <div class="flex-shrink-0 text-center text-md-left tw-whitespace-no-wrap torrents-list-size" v-html="magnet.size"></div>
</div>
</template>
