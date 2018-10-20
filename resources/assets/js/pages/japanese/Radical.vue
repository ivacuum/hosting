<script>
import locale from '../../i18n/locale'
import KanjiList from '../../components/japanese/KanjiList.vue'
import BurnRadical from '../../components/japanese/BurnRadical.vue'

export default {
  components: {
    KanjiList,
    BurnRadical,
  },

  props: {
    meaning: String,
  },

  data() {
    return {
      guest: !window.AppOptions.loggedIn,
      radical: {},
    }
  },

  beforeRouteEnter(to, from, next) {
    axios
      .get(`${locale}/japanese/wanikani/radicals/${to.params.meaning}`)
      .then((response) => {
        next((vm) => {
          vm.radical = response.data.data
          document.title = response.data.data.meaning
        })
      })
  },

  beforeRouteUpdate(to, from, next) {
    axios
      .get(`${locale}/japanese/wanikani/radicals/${to.params.meaning}`)
      .then((response) => {
        this.radical = response.data.data
        document.title = response.data.data.meaning
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
      :to="{ name: 'wk.level', params: { level: radical.level }}"
    >{{ radical.level }}</router-link>
    <div class="bg-radical text-white mr-3 px-2 py-1 rounded">
      <span class="ja-character ja-shadow-light" v-if="radical.character">{{ radical.character }}</span>
      <img class="d-block ja-character ja-image-shadow" :src="radical.image" alt="" height="38" v-else>
    </div>
    <div class="text-capitalize">{{ radical.meaning }}</div>
  </div>

  <kanji-list
    burned
    flat
    :key="radical.id"
    :radical-id="radical.id"
    v-if="radical.id"
  />

  <div class="mt-4">
    <a :href="`https://www.wanikani.com/radicals/${radical.meaning}`" rel="noreferrer">
      WaniKani
      <span v-html="$root.svg.external_link"></span>
    </a>
  </div>

  <div class="mt-4" v-if="!guest">
    <burn-radical
      :id="radical.id"
      :burned="radical.burned"
    />
  </div>
</div>
</template>
