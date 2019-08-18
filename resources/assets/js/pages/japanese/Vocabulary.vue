<script>
import { mapState } from 'vuex'
import locale from '../../i18n/locale'
import KanjiList from '../../components/japanese/KanjiList.vue'
import BurnVocabulary from '../../components/japanese/BurnVocabulary.vue'

export default {
  components: {
    KanjiList,
    BurnVocabulary,
  },

  props: {
    characters: String,
  },

  data() {
    return {
      vocab: {},
    }
  },

  beforeRouteEnter(to, from, next) {
    axios
      .get(`${locale}/japanese/wanikani/vocabulary/${to.params.characters}`)
      .then((response) => {
        next((vm) => {
          vm.vocab = response.data.data
          document.title = response.data.data.character
        })
      })
  },

  beforeRouteUpdate(to, from, next) {
    axios
      .get(`${locale}/japanese/wanikani/vocabulary/${to.params.characters}`)
      .then((response) => {
        this.vocab = response.data.data
        document.title = response.data.data.character
        next()
      })
  },

  computed: mapState({
    guest: state => state.global.guest,
  }),
}
</script>

<template>
<div>
  <div class="align-items-center d-flex flex-wrap h1">
    <router-link
      class="bg-secondary ja-shadow-light tw-mr-2 px-3 py-1 rounded text-white"
      :to="{ name: 'wk.level', params: { level: vocab.level }}"
    >{{ vocab.level }}</router-link>
    <div class="bg-vocab ja-shadow-light tw-mr-4 px-2 py-1 rounded text-white">{{ vocab.character }}</div>
    <div class="f24 text-capitalize">{{ vocab.meaning }}</div>
  </div>

  <div class="align-items-center d-flex flex-wrap">
    <span class="text-muted">{{ $t('japanese.reading') }}</span>
    <span class="f20">【{{ vocab.kana }}】</span>
    <div v-if="vocab.audio">
      <button class="btn btn-default btn-sm" @click="$refs.audio.play()">Play</button>
      <audio ref="audio" :src="vocab.audio"></audio>
    </div>
  </div>

  <kanji-list
    burned
    flat
    :key="vocab.id"
    :vocabulary-id="vocab.id"
    v-if="vocab.id"
  />

  <div class="tw-mt-12" v-if="vocab.sentences">
    <h3 class="tw-mt-0">{{ $t('japanese.sentences') }}</h3>
    <div class="f20 pre-line">{{ vocab.sentences }}</div>
  </div>

  <div class="tw-mt-6">
    <a class="tw-mr-4" :href="`https://www.wanikani.com/vocabulary/${vocab.character}`" rel="noreferrer">
      WaniKani
      <span v-html="$root.svg.external_link"></span>
    </a>

    <a class="tw-mr-4" :href="`https://www.japandict.com/${vocab.character}`" rel="noreferrer">
      JapanDict
      <span v-html="$root.svg.external_link"></span>
    </a>

    <a :href="`https://jisho.org/search/${vocab.character}`" rel="noreferrer">
      Jisho
      <span v-html="$root.svg.external_link"></span>
    </a>
  </div>

  <div class="tw-mt-6" v-if="!guest">
    <burn-vocabulary
      :id="vocab.id"
      :burned="vocab.burned"
    />
  </div>
</div>
</template>
