<template>
<div>
  <transition appear name="fade">
    <div v-show="loaded">
      <div v-if="showGroupActionButtons">
        <p>
          <button
            class="btn btn-default"
            @click="toggleLabels"
          >{{ toggleLabelsText }}</button>
          <button
            class="btn btn-default"
            @click="shuffleAll"
          >{{ $t('SHUFFLE_ALL') }}</button>
          <button
            class="btn btn-default"
            @click="toggleBurned"
            v-if="!guest"
          >{{ toggleBurnedText }}</button>
        </p>
        <div class="flex flex-wrap items-center" v-if="Object.keys(filteredElements).length > 1">
          <template v-for="(collection, lvl) in filteredElements">
            <a class="flex bg-gray-600 hover:bg-gray-700 text-white hover:text-gray-100 px-2 text-base font-bold rounded ja-shadow-light mr-1 mb-1" :href="`#level-${lvl}`">
              {{ lvl }}
            </a>
          </template>
        </div>
      </div>
      <template v-for="(collection, lvl) in filteredElements">
        <a :id="`level-${lvl}`"></a>
        <div class="sm:flex items-center justify-between mt-6 mb-1">
          <h3>
            <span>{{ titleLabel(lvl) }}</span>
            <span class="text-base text-muted">{{ collection.length }}</span>
          </h3>
          <div>
            <button
              class="btn btn-default"
              @click="toggleLabels"
              v-if="showToggleLabelsButton"
            >{{ toggleLabelsText }}</button>
            <button
              class="btn btn-default"
              @click="shuffleLevel(lvl)"
              v-if="showShuffleLevelButton(collection.length)"
            >{{ $t('SHUFFLE') }}</button>
            <button
              class="btn btn-default"
              @click="toggleBurned"
              v-if="showToggleBurnedButton"
            >{{ toggleBurnedText }}</button>
          </div>
        </div>
        <div class="font-bold radicals-grid text-center text-white" is="transition-group" name="grid">
          <div
            class="bg-radical pb-2 rounded"
            :class="{ 'labels-hidden': !labels, 'bg-burned': row.burned }"
            :key="row.id"
            v-for="row in collection"
          >
            <router-link class="block pt-1 text-white hover:text-gray-200" :to="{ name: 'wk.radical', params: { meaning: row.meaning }}">
              <div class="py-2" v-if="row.image">
                <img class="inline ja-character ja-image-shadow h-16" :src="row.image" alt="">
              </div>
              <div class="ja-big ja-character ja-shadow pb-2" v-else>{{ row.character }}</div>
            </router-link>
            <div class="font-bold ja-shadow-light radical-meaning capitalize">{{ row.meaning }}</div>
          </div>
        </div>
      </template>
    </div>
  </transition>
</div>
</template>

<script>
import { mapState } from 'vuex'
import locale from '../../i18n/locale'
import shuffle from 'lodash/shuffle'
import I18nMessages from '../../i18n/japanese'

export default {
  props: {
    burned: {
      type: Boolean,
      default: false,
    },
    flat: {
      type: Boolean,
      default: false,
    },
    kanjiId: {
      type: Number,
      default: undefined,
    },
    level: {
      type: Number,
      default: undefined,
    },
  },

  data() {
    return {
      labels: false,
      loaded: false,
      elements: [],
    }
  },

  i18n: {
    messages: I18nMessages,
  },

  created() {
    this.loadData()
  },

  computed: {
    ...mapState({
      guest: state => state.global.guest,
    }),

    filteredElements() {
      if (this.burned) {
        return this.elements
      }

      let result = {}

      for (let level in this.elements) {
        let ary = this.elements[level].filter(el => !el.burned)

        if (ary.length) {
          result[level] = ary
        }
      }

      return result
    },

    showGroupActionButtons() {
      return this.level === undefined && !this.kanjiId
    },

    showToggleBurnedButton() {
      if (this.guest || this.kanjiId) return false

      return this.flat || this.level > 0
    },

    showToggleLabelsButton() {
      return this.flat || this.level > 0
    },

    toggleBurnedText() {
      return this.$i18n.t(this.burned ? 'BURNED_HIDE' : 'BURNED_SHOW')
    },

    toggleLabelsText() {
      return this.$i18n.t(this.labels ? 'LABELS_HIDE' : 'LABELS_SHOW')
    },
  },

  methods: {
    loadData() {
      axios
        .get(`${locale}/japanese/wanikani/radicals`, {
          params: {
            level: this.level,
            kanji_id: this.kanjiId,
          }
        })
        .then((response) => {
          if (this.flat) {
            // Объединение уровней в один для страницы кандзи
            if (response.data.data.length) {
              this.elements = { 0: response.data.data }
            }
          } else {
            this.elements = response.data.data
          }

          this.loaded = true
        })
    },

    shuffleAll() {
      for (let level in this.elements) {
        this.shuffleLevel(level)
      }
    },

    showShuffleLevelButton(length) {
      return !this.flat && length > 1
    },

    shuffleLevel(level) {
      this.elements[level] = shuffle(this.elements[level])
    },

    titleLabel(level) {
      if (this.level === undefined && !this.flat) {
        return this.$i18n.t('LEVEL', { level })
      }

      return this.$i18n.t('RADICALS')
    },

    toggleBurned() {
      this.burned = !this.burned
    },

    toggleLabels() {
      this.labels = !this.labels
    }
  },

  watch: {
    level() {
      this.loadData()
    }
  }
}
</script>

<style lang="scss">
.labels-hidden .radical-meaning { visibility: hidden; }
.labels-hidden:hover .radical-meaning,
.labels-hidden:focus .radical-meaning { visibility: visible; }
</style>
