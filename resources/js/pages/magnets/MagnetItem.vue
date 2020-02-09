<script>
import { mapState } from 'vuex'
import MagnetItem from '../../components/magnets/MagnetItem.vue'
import CommentItem from '../../components/CommentItem'
import CommentAdd from '../../components/CommentAdd'

export default {
  components: { CommentAdd, CommentItem, MagnetItem },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      vm.$store.dispatch('fetchMagnet', to.params.id)
    })
  },

  beforeRouteUpdate(to, from, next) {
    this.$store.dispatch('fetchMagnet', to.params.id)
      .then(() => {
        next()
      })
  },

  destroyed() {
    this.$store.dispatch('unsetMagnet')
  },

  computed: mapState({
    magnet: state => state.magnets.resource,
    categoryList: state => state.magnets.categoryList,
  }),

  methods: {
    download(magnet) {
      this.$store.dispatch('clickMagnet', magnet)
    },

    searchUrl(q) {
      return {
        name: 'magnets',
        query: { ...this.$route.query, page: undefined, q },
      }
    },
  }
}
</script>

<template>
<div v-if="magnet.html">
  <rutracker-post>
    <div v-html="magnet.html"></div>
  </rutracker-post>

  <div class="svg-labels text-muted">
    <span
      class="svg-flex svg-label svg-muted tooltipped tooltipped-n"
      :aria-label="$t('model.torrent.updated_at')"
    >
      <span v-html="$root.svg.calendar"></span>
      {{ magnet.registered_at }}
    </span>
    <span
      class="svg-flex svg-label svg-muted tooltipped tooltipped-n"
      :aria-label="$t('model.torrent.views')"
    >
      <span v-html="$root.svg.eye"></span>
      {{ magnet.views }}
    </span>
    <span
      class="svg-flex svg-label svg-muted tooltipped tooltipped-n"
      :aria-label="$t('model.torrent.clicks')"
    >
      <span v-html="$root.svg.magnet"></span>
      {{ magnet.clicks }}
    </span>
    <a
      class="svg-flex svg-muted tooltipped tooltipped-n"
      :href="magnet.external_link"
      :aria-label="$t('torrents.source')"
      v-html="$root.svg.external_link"
    ></a>
    <a class="btn btn-success svg-flex svg-label" :href="magnet.magnet" @click="download(magnet)">
      <span v-html="$root.svg.magnet"></span>
      {{ $t('torrents.download') }}
      <span class="mx-2">&middot;</span>
      <span v-html="magnet.size"></span>
    </a>
  </div>

  <div class="mt-4" v-if="magnet.title_tags.length">
    <router-link
      class="btn btn-outline-primary mb-1 mr-1 py-1 text-sm lowercase"
      :to="searchUrl(tag)"
      v-for="(tag, i) in magnet.title_tags"
      :key="i"
    >#{{ tag }}</router-link>
  </div>

  <div v-if="magnet.related.length">
    <div class="h3 mt-12">
      {{ $t('torrents.related') }}
      <span class="text-base text-muted">{{ magnet.related.length }}</span>
    </div>
    <template v-for="related in magnet.related">
      <magnet-item
        :magnet="related"
        :category="categoryList[related.category_id]"
        :key="related.id"
      />
    </template>
  </div>

  <div class="h3 mt-12">
    {{ $t('comments.discussion') }}
    <span class="text-base text-muted">{{ magnet.comments.length }}</span>
  </div>
  <a id="comments"></a>
  <div v-for="comment in magnet.comments" :key="comment.id">
    <comment-item :comment="comment"/>
  </div>
  <comment-add :user="magnet.user"/>
</div>
</template>
