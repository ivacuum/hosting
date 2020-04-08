<template>
<div>
  <div class="items-center md:flex justify-between mb-4 md:mb-0 -mt-2">
    <div class="flex flex-wrap" v-if="results">
      <h3 class="mb-2 md:mb-0 mr-4 pt-1">{{ $t('RESULTS', { results }) }}</h3>
      <button class="btn btn-default mb-2 md:mb-0" @click="reset">{{ $t('CLEAR') }}</button>
    </div>
    <div class="hidden md:block" v-else>&nbsp;</div>
    <form class="max-w-500px" @submit.prevent="onSubmit">
      <div class="flex w-full">
        <input
          class="form-control rounded-r-none js-search-input"
          v-model="q"
          :placeholder="$t('SEARCH')"
          autocapitalize="none"
        >
        <button class="btn btn-default -ml-px rounded-l-none" v-html="$root.svg.search"></button>
      </div>
    </form>
  </div>
  <div class="my-4" v-if="Object.keys(elements).length">
    <router-link
      class="items-center bg-radical border-radical flex justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
      :to="{ name: 'wk.radical', params: { meaning: row.meaning }}"
      @click.native="reset"
      v-for="row in elements.radicals"
      :key="row.id"
    >
      <div class="flex-shrink-0" v-if="row.image">
        <img class="ja-character ja-image-shadow h-12" :src="row.image" alt="">
      </div>
      <div class="text-4xl flex-shrink-0 font-bold ja-character ja-shadow pb-1 whitespace-no-wrap" v-else>{{ row.character }}</div>
      <div class="flex-grow ja-shadow-light text-xs capitalize text-right">{{ row.meaning }}</div>
    </router-link>

    <router-link
      class="items-center bg-kanji border-kanji flex justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
      :to="{ name: 'wk.kanji', params: { character: row.character }}"
      @click.native="reset"
      v-for="row in elements.kanji"
      :key="row.id"
    >
      <div class="text-4xl flex-shrink-0 font-bold ja-character ja-shadow pb-1 whitespace-no-wrap">{{ row.character }}</div>
      <div class="flex-grow text-right">
        <div class="font-bold ja-shadow-light">{{ row.reading }}</div>
        <div class="ja-shadow-light text-xs capitalize">{{ row.meaning }}</div>
      </div>
    </router-link>

    <router-link
      class="items-center bg-vocab border-vocab flex justify-between px-2 sm:px-4 py-2 text-white hover:text-grey-200"
      :to="{ name: 'wk.vocabulary', params: { characters: row.character }}"
      @click.native="reset"
      v-for="row in elements.vocabulary"
      :key="row.id"
    >
      <div class="text-4xl flex-shrink-0 font-bold ja-character ja-shadow pb-1 whitespace-no-wrap">{{ row.character }}</div>
      <div class="flex-grow text-right">
        <div class="font-bold ja-shadow-light">{{ row.kana }}</div>
        <div class="ja-shadow-light text-xs capitalize">{{ row.meaning }}</div>
      </div>
    </router-link>
  </div>
</div>
</template>

<script>
import locale from '../../i18n/locale'

export default {
  data() {
    return {
      q: '',
      results: 0,
      elements: [],
    }
  },

  i18n: {
    messages: {
      en: {
        CLEAR: 'Clear',
        SEARCH: 'Search...',
        RESULTS: 'Results: {results}',
        SHORT_QUERY: 'Search query should be at least 3 characters long',
      },
      ru: {
        CLEAR: 'Очистить',
        SEARCH: 'Поиск...',
        RESULTS: 'Результатов: {results}',
        SHORT_QUERY: 'Поисковый запрос должен быть не менее 3 символов',
      },
    },
  },

  methods: {
    onSubmit() {
      axios
        .post(`${locale}/japanese/wanikani/search`, { q: this.q })
        .then((response) => {
          this.results = Number(response.data.count)
          this.elements = {
            count: Number(response.data.count),
            kanji: response.data.kanji.data,
            radicals: response.data.radicals.data,
            vocabulary: response.data.vocabulary.data,
          }
        })
        .catch((error) => {
          if (!error.response) return

          if (error.response.status === 422) {
            notie.alert({
              type: 'error',
              text: this.$i18n.t('SHORT_QUERY'),
            })

            document.querySelector('.js-search-input').focus()
          }
        })
    },

    reset() {
      this.results = 0
      this.elements = []
    }
  }
}
</script>
