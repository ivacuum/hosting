<script>
import { mapState } from 'vuex'
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

  computed: mapState({
    guest: state => state.global.guest,
  }),
}
</script>

<template>
<div>
  <div class="items-center flex flex-wrap text-3xl">
    <router-link
      class="bg-grey-700 hover:bg-grey-800 font-medium ja-shadow-light mr-2 px-3 rounded text-white hover:text-white"
      :to="{ name: 'wk.level', params: { level: radical.level }}"
    >{{ radical.level }}</router-link>
    <div class="bg-radical text-white mr-3 px-2 rounded">
      <span class="font-bold ja-shadow-light" v-if="radical.character">{{ radical.character }}</span>
      <div v-else>
        <div class="ja-image-shadow ja-svg text-3xl" v-html="radical.image"></div>
      </div>
    </div>
    <div class="capitalize">{{ radical.meaning }}</div>
  </div>

  <kanji-list
    burned
    flat
    :key="radical.id"
    :radical-id="radical.id"
    v-if="radical.id"
  />

  <div class="mt-6">
    <a :href="`https://www.wanikani.com/radicals/${radical.meaning}`" rel="noreferrer">
      WaniKani
      <span v-html="$root.svg.external_link"></span>
    </a>
  </div>

  <div class="mt-6" v-if="!guest">
    <burn-radical
      :id="radical.id"
      :burned="radical.burned"
    />
  </div>
</div>
</template>
