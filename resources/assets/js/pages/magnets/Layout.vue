<script>
import { mapState } from 'vuex'
import TheSearch from '../../components/magnets/TheSearch.vue'

export default {
  components: { TheSearch },

  computed: mapState({
    magnet: state => state.magnets.resource,
  }),

  methods: {
    download(magnet) {
      this.$store.dispatch('clickMagnet', magnet)
    }
  }
}
</script>

<template>
<div class="font-smooth">
  <div class="d-lg-flex flex-row-reverse align-items-center justify-content-between mt-n1 mt-lg-n2 mb-3">
    <the-search/>

    <div class="mr-3 text-center" v-if="magnet.magnet">
      <a class="btn btn-success js-magnet" :href="magnet.magnet" @click="download(magnet)">
        <span class="mr-1" v-html="$root.svg.magnet"></span>
        {{ $t('torrents.download') }}
        <span class="mx-1">&middot;</span>
        <span v-html="magnet.size"></span>
      </a>
    </div>

    <!-- torrent download button -->
    <div class="nav-link-tabs-fader nav-border">
      <div class="nav-scroll-container">
        <div class="nav-scroll">
          <nav class="nav nav-link-tabs">
            <router-link class="nav-link" to="/magnets" exact>
              {{ $t('torrents.new') }}
            </router-link>
            <router-link class="nav-link" to="/magnets/add">
              {{ $t('torrents.create') }}
            </router-link>
            <router-link class="nav-link" to="/magnets/faq">
              {{ $t('torrents.faq') }}
            </router-link>
            <router-link class="nav-link" to="/magnets/comments">
              {{ $t('torrents.comments') }}
            </router-link>
            <router-link class="nav-link" to="/magnets/my">
              {{ $t('torrents.my') }}
            </router-link>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <router-view/>
</div>
</template>
