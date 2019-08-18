<template>
<div>
  <div class="align-items-center d-md-flex justify-content-between mb-3 mb-md-0 mt-n2">
    <div class="d-flex flex-wrap" v-if="results">
      <h3 class="mb-2 mb-md-0 mr-3 pt-1">{{ $t('RESULTS', { results }) }}</h3>
      <button class="btn btn-default mb-2 mb-md-0" @click="reset">{{ $t('CLEAR') }}</button>
    </div>
    <div class="d-none d-md-block" v-else>&nbsp;</div>
    <form class="mw-500" @submit.prevent="onSubmit">
      <div class="input-group">
        <input
          class="form-control js-search-input"
          v-model="q"
          :placeholder="$t('SEARCH')"
          autocapitalize="none"
        >
        <div class="input-group-append">
          <button class="btn btn-default" v-html="$root.svg.search"></button>
        </div>
      </div>
    </form>
  </div>
  <div class="my-3" v-if="Object.keys(elements).length">
    <router-link
      class="align-items-center bg-radical border-radical d-flex justify-content-between px-2 px-sm-3 py-2 text-white"
      :to="{ name: 'wk.radical', params: { meaning: row.meaning }}"
      @click.native="reset"
      v-for="row in elements.radicals"
      :key="row.id"
    >
      <div class="flex-shrink-0" v-if="row.image">
        <img class="ja-character ja-image-shadow" :src="row.image" alt="" height="36">
      </div>
      <div class="f36 flex-shrink-0 font-weight-bold ja-character ja-shadow pb-1 tw-whitespace-no-wrap" v-else>{{ row.character }}</div>
      <div class="flex-grow-1 ja-shadow-light small text-capitalize text-right">{{ row.meaning }}</div>
    </router-link>

    <router-link
      class="align-items-center bg-kanji border-kanji d-flex justify-content-between px-2 px-sm-3 py-2 text-white"
      :to="{ name: 'wk.kanji', params: { character: row.character }}"
      @click.native="reset"
      v-for="row in elements.kanji"
      :key="row.id"
    >
      <div class="f36 flex-shrink-0 font-weight-bold ja-character ja-shadow pb-1 tw-whitespace-no-wrap">{{ row.character }}</div>
      <div class="flex-grow-1 text-right">
        <div class="font-weight-bold ja-shadow-light">{{ row.reading }}</div>
        <div class="ja-shadow-light small text-capitalize">{{ row.meaning }}</div>
      </div>
    </router-link>

    <router-link
      class="align-items-center bg-vocab border-vocab d-flex justify-content-between px-2 px-sm-3 py-2 text-white"
      :to="{ name: 'wk.vocabulary', params: { characters: row.character }}"
      @click.native="reset"
      v-for="row in elements.vocabulary"
      :key="row.id"
    >
      <div class="f36 flex-shrink-0 font-weight-bold ja-character ja-shadow pb-1 tw-whitespace-no-wrap">{{ row.character }}</div>
      <div class="flex-grow-1 text-right">
        <div class="font-weight-bold ja-shadow-light">{{ row.kana }}</div>
        <div class="ja-shadow-light small text-capitalize">{{ row.meaning }}</div>
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
