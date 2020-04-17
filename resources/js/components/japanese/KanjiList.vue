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
            <a class="flex bg-grey-600 hover:bg-grey-700 text-white hover:text-grey-100 px-2 text-base font-bold rounded ja-shadow-light mr-1 mb-1" :href="`#level-${lvl}`">
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
        <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-7 xl:grid-cols-8 gap-px font-bold text-center text-white" is="transition-group" name="grid">
          <div class="bg-kanji pb-2 rounded"
               :class="{ 'labels-hidden': !labels, 'bg-burned': row.burned }"
               :key="row.id"
               v-for="row in collection"
          >
            <router-link
              class="block text-6xl leading-none ja-shadow py-2 text-white hover:text-grey-200"
              :to="{ name: 'wk.kanji', params: { character: row.character }}"
            >{{ row.character }}</router-link>
            <div class="kanji-reading ja-shadow-light">{{ row.reading }}</div>
            <div class="kanji-meaning ja-shadow-light capitalize">{{ row.first_meaning }}</div>
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
    level: {
      type: Number,
      default: undefined,
    },
    radicalId: {
      type: Number,
      default: undefined,
    },
    similarId: {
      type: Number,
      default: undefined,
    },
    vocabularyId: {
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
      return this.level === undefined && !this.radicalId && !this.similarId && !this.vocabularyId
    },

    showToggleBurnedButton() {
      if (this.guest || this.radicalId || this.similarId || this.vocabularyId) {
        return false
      }

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
        .get(`${locale}/japanese/wanikani/kanji`, {
          params: {
            level: this.level,
            similar_id: this.similarId,
            radical_id: this.radicalId,
            vocabulary_id: this.vocabularyId,
          }
        })
        .then((response) => {
          if (this.flat) {
            if (response.data.data.length) {
              this.elements = { 0: response.data.data }
            }
          } else {
            this.elements = response.data.data
          }

          this.loaded = true
        })
    },

    showShuffleLevelButton(length) {
      return !this.flat && length > 1
    },

    shuffleAll() {
      for (let level in this.elements) {
        this.shuffleLevel(level)
      }
    },

    shuffleLevel(level) {
      this.elements[level] = shuffle(this.elements[level])
    },

    titleLabel(level) {
      if (this.level === undefined && !this.flat) {
        return this.$i18n.t('LEVEL', { level })
      }

      if (this.similarId) {
        return this.$i18n.t('SIMILAR_KANJI')
      }

      return this.$i18n.t('KANJI')
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
.labels-hidden {
  .kanji-meaning,
  .kanji-reading { visibility: hidden; }

  &:hover .kanji-meaning,
  &:hover .kanji-reading,
  &:focus .kanji-meaning,
  &:focus .kanji-reading { visibility: visible; }
}
</style>
