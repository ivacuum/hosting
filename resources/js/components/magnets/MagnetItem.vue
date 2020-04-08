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
  class="flex flex-wrap md:flex-no-wrap justify-center md:justify-start torrents-list-container js-torrents-views-observer"
  :data-id="magnet.id"
  :key="magnet.id"
>
  <div
    class="flex-shrink-0 order-1 md:order-none w-8 torrent-icon mr-1 md:text-2xl"
    :title="category.title"
    v-html="$root.svg[category.icon]"
  ></div>
  <router-link class="flex-grow mb-2 md:mb-0 md:mr-4 visited" :to="{ name: 'magnet', params: { id: magnet.id }}">
    <torrent-title :title="magnet.title" hide_brackets=""/>
  </router-link>
  <a
    class="flex-shrink-0 pr-2 torrents-list-magnet text-center md:text-left whitespace-no-wrap"
    :href="magnet.magnet"
    :title="$t('torrents.download')"
    @click="download(magnet)"
  >
    <span v-html="$root.svg.magnet"></span>
    <span v-if="magnet.clicks > 0">{{ magnet.clicks }}</span>
  </a>
  <div class="flex-shrink-0 text-center md:text-left whitespace-no-wrap torrents-list-size" v-html="magnet.size"></div>
</div>
</template>
