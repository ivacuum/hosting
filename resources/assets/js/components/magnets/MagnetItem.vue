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
  class="tw-flex tw-flex-wrap md:tw-flex-no-wrap tw-justify-center md:tw-justify-start torrents-list-container js-torrents-views-observer"
  :data-id="magnet.id"
  :key="magnet.id"
>
  <div
    class="tw-flex-shrink-0 order-1 order-md-0 torrents-list-icon torrent-icon"
    :title="category.title"
    v-html="$root.svg[category.icon]"
  ></div>
  <router-link class="tw-flex-grow tw-mb-2 md:tw-mb-0 md:tw-mr-4 visited" :to="{ name: 'magnet', params: { id: magnet.id }}">
    <torrent-title :title="magnet.title" hide_brackets=""/>
  </router-link>
  <a
    class="tw-flex-shrink-0 tw-pr-2 torrents-list-magnet tw-text-center md:tw-text-left tw-whitespace-no-wrap"
    :href="magnet.magnet"
    :title="$t('torrents.download')"
    @click="download(magnet)"
  >
    <span v-html="$root.svg.magnet"></span>
    <span v-if="magnet.clicks > 0">{{ magnet.clicks }}</span>
  </a>
  <div class="tw-flex-shrink-0 tw-text-center md:tw-text-left tw-whitespace-no-wrap torrents-list-size" v-html="magnet.size"></div>
</div>
</template>
