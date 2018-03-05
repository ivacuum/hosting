<template>
<div>
  <div v-if="level === 0">
    <p>
      <button class="btn btn-default" @click="toggleLabels()">{{ toggleLabelsText }}</button>
      <button class="btn btn-default" @click="shuffleAll()">Перемешать все</button>
      <button class="btn btn-default" @click="toggleBurned()" v-if="!guest">{{ toggleBurnedText }}</button>
    </p>
    <div class="d-flex flex-wrap align-items-center">
      <template v-for="(collection, lvl) in filteredElements">
        <a class="badge badge-secondary f16 mr-1 mb-1" :href="`#level-${lvl}`">
          {{ lvl }}
        </a>
      </template>
    </div>
  </div>
  <template v-for="(collection, lvl) in filteredElements">
    <a :name="`level-${lvl}`"></a>
    <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-1">
      <h3>
        <span v-if="level === 0">Уровень {{ lvl }}</span>
        <span v-else>Кандзи</span>
        <small class="text-muted">{{ collection.length }}</small>
      </h3>
      <div>
        <button class="btn btn-default" @click="toggleLabels()" v-if="level > 0">{{ toggleLabelsText }}</button>
        <button class="btn btn-default" @click="shuffleLevel(lvl)">Перемешать</button>
        <button class="btn btn-default" @click="toggleBurned()" v-if="level > 0 && !guest">{{ toggleBurnedText }}</button>
      </div>
    </div>
    <div class="font-weight-bold kanji-grid text-center text-white" is="transition-group" name="grid">
      <div class="bg-kanji pb-2 rounded"
           :class="{ 'labels-hidden': !labels, 'bg-burned': row.burned }"
           :key="row.id"
           v-for="row in collection"
      >
        <a class="d-block ja-big ja-character ja-shadow pt-1 pb-2 text-white" :href="row.slug">{{ row.character }}</a>
        <div class="kanji-reading ja-shadow-light">{{ row.reading }}</div>
        <div class="kanji-meaning ja-shadow-light text-capitalize">{{ row.meaning }}</div>
      </div>
    </div>
  </template>
</div>
</template>

<script>
let shuffle = require('lodash/shuffle')

export default {
  props: {
    action: String,
    level: {
      type: Number,
      default: 0,
    }
  },

  data() {
    return {
      guest: false,
      burned: false,
      labels: false,
      elements: [],
    }
  },

  mounted() {
    this.guest = !window['AppOptions'].loggedIn

    axios.get(`${this.action}?level=${this.level}`)
      .then((response) => {
        this.elements = response.data.kanji
      })
  },

  computed: {
    filteredElements: function () {
      if (this.burned) {
        return this.elements
      }

      let result = {}

      for (let level in this.elements) {
        result[level] = this.elements[level].filter(el => !el.burned)
      }

      return result
    },

    toggleBurnedText: function () {
      return this.burned ? 'Скрыть сожженные' : 'Показать сожженные';
    },

    toggleLabelsText: function () {
      return this.labels ? 'Подписывать при наведении' : 'Показать подписи'
    }
  },

  methods: {
    shuffleAll() {
      for (let level in this.elements) {
        this.shuffleLevel(level)
      }
    },

    shuffleLevel(level) {
      this.elements[level] = shuffle(this.elements[level])
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
