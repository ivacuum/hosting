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
        <div class="d-flex flex-wrap align-items-center" v-if="Object.keys(filteredElements).length > 1">
          <template v-for="(collection, lvl) in filteredElements">
            <a class="badge badge-secondary f16 ja-shadow-light mr-1 mb-1" :href="`#level-${lvl}`">
              {{ lvl }}
            </a>
          </template>
        </div>
      </div>
      <template v-for="(collection, lvl) in filteredElements">
        <a :name="`level-${lvl}`"></a>
        <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-1">
          <h3>
            <span>{{ titleLabel(lvl) }}</span>
            <small class="text-muted">{{ collection.length }}</small>
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
        <div class="f20 text-center text-md-left vocab-grid">
          <template v-for="row in collection">
            <div>
              <a
                class="bg-vocab d-inline-block f36 ja-character ja-shadow-light px-2 py-1 rounded text-nowrap text-white"
                :class="{ 'bg-burned': row.burned }"
                :href="row.slug"
              >{{ row.character }}</a>
            </div>
            <a
              class="my-3 my-md-0 pl-md-3 pr-md-2 py-md-1"
              :class="{ invisible: labels }"
              href="#"
              @click.prevent="reveal(row.id)"
            >？</a>
            <div
              class="text-muted"
              :class="{ invisible: !labels && !revealed.includes(row.id), 'mt-3 mt-md-0': labels }"
              :id="`kana-${row.id}`"
            >
              <div class="ja-character text-nowrap" v-for="kana in row.kana.split(', ')">
                【{{ kana }}】
              </div>
            </div>
            <div
              :class="{ invisible: !labels && !revealed.includes(row.id), 'mb-4 mb-md-0': row.burned || guest }"
              :id="`meaning-${row.id}`"
            >{{ row.meaning }}</div>
            <a
              class="mb-4 mb-md-0 px-md-2 py-md-1 text-danger"
              :class="{ invisible: row.burned || guest || (!labels && !revealed.includes(row.id)) }"
              href="#"
              @click.prevent="burn(lvl, row.id)"
            >
              <svg class="svg-icon svg-flame" viewBox="0 0 12 16" width="16" height="16"><path d="M5.05.31c.81 2.17.41 3.38-.52 4.31C3.55 5.67 1.98 6.45.9 7.98c-1.45 2.05-1.7 6.53 3.53 7.7-2.2-1.16-2.67-4.52-.3-6.61-.61 2.03.53 3.33 1.94 2.86 1.39-.47 2.3.53 2.27 1.67-.02.78-.31 1.44-1.13 1.81 3.42-.59 4.78-3.42 4.78-5.56 0-2.84-2.53-3.22-1.25-5.61-1.52.13-2.03 1.13-1.89 2.75.09 1.08-1.02 1.8-1.86 1.33-.67-.41-.66-1.19-.06-1.78C8.18 5.31 8.68 2.45 5.05.32L5.03.3l.02.01z"/></svg>
            </a>
          </template>
        </div>
      </template>
    </div>
  </transition>
</div>
</template>

<script>
import I18nMessages from './../i18n/japanese'

let shuffle = require('lodash/shuffle')

export default {
  props: {
    action: String,
    burned: {
      type: Boolean,
      default: false,
    },
    flat: {
      type: Boolean,
      default: false,
    },
    kanji: {
      type: String,
      default: '',
    },
    level: {
      type: Number,
      default: 0,
    },
  },

  data() {
    return {
      guest: false,
      labels: false,
      loaded: false,
      elements: [],
      revealed: [],
    }
  },

  i18n: {
    messages: I18nMessages,
  },

  mounted() {
    this.guest = !window['AppOptions'].loggedIn

    axios.get(`${this.action}?kanji=${this.kanji}&level=${this.level}`)
      .then((response) => {
        if (this.flat) {
          if (response.data.vocabulary.length) {
            this.elements = { 0: response.data.vocabulary }
          }
        } else {
          this.elements = response.data.vocabulary
        }

        this.loaded = true
      })
  },

  computed: {
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
      return this.level === 0 && !this.kanji
    },

    showToggleBurnedButton() {
      if (this.guest) {
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
    burn(level, id) {
      axios.delete(`/japanese/wanikani/vocabulary/${id}`)
        .then((response) => {
          if (response.data.status === 'OK') {
            const i = this.elements[level].findIndex((el) => el.id === id)

            this.elements[level][i].burned = true
          }
        })
    },

    reveal(id) {
      const i = this.revealed.indexOf(id)

      i !== -1 ? this.revealed.splice(i, 1) : this.revealed.push(id)
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
      if (this.level === 0 && !this.flat) {
        return this.$i18n.t('LEVEL', { level })
      }

      return this.$i18n.t('VOCABULARY')
    },

    toggleBurned() {
      this.burned = !this.burned
    },

    toggleLabels() {
      this.labels = !this.labels
    }
  }
}
</script>
