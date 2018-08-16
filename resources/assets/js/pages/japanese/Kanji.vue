<script>
import locale from '../../i18n/locale'
import BurnKanji from '../../components/japanese/BurnKanji.vue'
import KanjiList from '../../components/japanese/KanjiList.vue'
import RadicalsList from '../../components/japanese/RadicalsList.vue'
import VocabularyList from '../../components/japanese/VocabularyList.vue'

export default {
  components: {
    BurnKanji,
    KanjiList,
    RadicalsList,
    VocabularyList,
  },

  props: {
    character: String,
  },

  data() {
    return {
      guest: !window.AppOptions.loggedIn,
      kanji: {},
    }
  },

  beforeRouteEnter(to, from, next) {
    axios
      .get(`${locale}/japanese/wanikani/kanji/${to.params.character}`)
      .then((response) => {
        next((vm) => {
          vm.kanji = response.data.data
          document.title = response.data.data.character
        })
      })
  },

  beforeRouteUpdate(to, from, next) {
    axios
      .get(`${locale}/japanese/wanikani/kanji/${to.params.character}`)
      .then((response) => {
        this.kanji = response.data.data
        document.title = response.data.data.character
        next()
      })
  },
}
</script>

<template>
<div>
  <div class="align-items-center d-flex flex-wrap h1">
    <router-link
      class="bg-secondary ja-shadow-light mr-2 px-3 py-1 rounded text-white"
      :to="{ name: 'wk.level', params: { level: kanji.level }}"
    >{{ kanji.level }}</router-link>
    <div class="bg-kanji ja-shadow-light text-white mr-3 px-2 py-1 rounded">{{ kanji.character }}</div>
    <div class="text-capitalize">{{ kanji.meaning }}</div>
  </div>

  <h3 class="mt-4">{{ $t('japanese.readings') }}</h3>
  <div class="mb-4">
    <span v-if="kanji.onyomi">
      <span class="text-muted">On'yomi</span>
      <span class="f20 mr-3">【{{ kanji.onyomi }}】</span>
    </span>
    <span v-if="kanji.kunyomi">
      <span class="text-muted">Kun'yomi</span>
      <span class="f20">【{{ kanji.kunyomi }}】</span>
    </span>
  </div>

  <radicals-list
    burned
    flat
    :kanji-id="kanji.id"
    v-if="kanji.id"
  />

  <kanji-list
    burned
    flat
    :similar-id="kanji.id"
    v-if="kanji.id"
  />

  <vocabulary-list
    burned
    flat
    :kanji="kanji.character"
    v-if="kanji.character"
  />

  <div class="mt-5">
    <a class="mr-3" :href="`https://www.wanikani.com/kanji/${kanji.character}`" rel="noreferrer">
      WaniKani
      <span v-html="$root.svg.external_link"></span>
    </a>

    <a class="mr-3" :href="`https://www.japandict.com/kanji/${kanji.character}`" rel="noreferrer">
      JapanDict
      <span v-html="$root.svg.external_link"></span>
    </a>

    <a :href="`https://jisho.org/search/${kanji.character}%20%23kanji`" rel="noreferrer">
      Jisho
      <span v-html="$root.svg.external_link"></span>
    </a>
  </div>

  <div class="mt-4" v-if="!guest">
    <burn-kanji
      :id="kanji.id"
      :burned="kanji.burned"
    />
  </div>
</div>
</template>
