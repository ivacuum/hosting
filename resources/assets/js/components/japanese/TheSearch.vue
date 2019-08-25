<template>
<div>
  <div class="tw-items-center md:tw-flex tw-justify-between tw-mb-4 md:tw-mb-0 tw--mt-2">
    <div class="tw-flex tw-flex-wrap" v-if="results">
      <h3 class="tw-mb-2 md:tw-mb-0 tw-mr-4 tw-pt-1">{{ $t('RESULTS', { results }) }}</h3>
      <button class="btn btn-default tw-mb-2 md:tw-mb-0" @click="reset">{{ $t('CLEAR') }}</button>
    </div>
    <div class="tw-hidden md:tw-block" v-else>&nbsp;</div>
    <form class="tw-max-w-500px" @submit.prevent="onSubmit">
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
  <div class="tw-my-4" v-if="Object.keys(elements).length">
    <router-link
      class="tw-items-center bg-radical border-radical tw-flex tw-justify-between tw-px-2 sm:tw-px-4 tw-py-2 tw-text-white hover:tw-text-gray-400"
      :to="{ name: 'wk.radical', params: { meaning: row.meaning }}"
      @click.native="reset"
      v-for="row in elements.radicals"
      :key="row.id"
    >
      <div class="tw-flex-shrink-0" v-if="row.image">
        <img class="ja-character ja-image-shadow" :src="row.image" alt="" height="36">
      </div>
      <div class="tw-text-4xl tw-flex-shrink-0 tw-font-bold ja-character ja-shadow tw-pb-1 tw-whitespace-no-wrap" v-else>{{ row.character }}</div>
      <div class="tw-flex-grow ja-shadow-light tw-text-xs tw-capitalize tw-text-right">{{ row.meaning }}</div>
    </router-link>

    <router-link
      class="tw-items-center bg-kanji border-kanji tw-flex tw-justify-between tw-px-2 sm:tw-px-4 tw-py-2 tw-text-white hover:tw-text-gray-400"
      :to="{ name: 'wk.kanji', params: { character: row.character }}"
      @click.native="reset"
      v-for="row in elements.kanji"
      :key="row.id"
    >
      <div class="tw-text-4xl tw-flex-shrink-0 tw-font-bold ja-character ja-shadow tw-pb-1 tw-whitespace-no-wrap">{{ row.character }}</div>
      <div class="tw-flex-grow tw-text-right">
        <div class="tw-font-bold ja-shadow-light">{{ row.reading }}</div>
        <div class="ja-shadow-light tw-text-xs tw-capitalize">{{ row.meaning }}</div>
      </div>
    </router-link>

    <router-link
      class="tw-items-center bg-vocab border-vocab tw-flex tw-justify-between tw-px-2 sm:tw-px-4 tw-py-2 tw-text-white hover:tw-text-gray-400"
      :to="{ name: 'wk.vocabulary', params: { characters: row.character }}"
      @click.native="reset"
      v-for="row in elements.vocabulary"
      :key="row.id"
    >
      <div class="tw-text-4xl tw-flex-shrink-0 tw-font-bold ja-character ja-shadow tw-pb-1 tw-whitespace-no-wrap">{{ row.character }}</div>
      <div class="tw-flex-grow tw-text-right">
        <div class="tw-font-bold ja-shadow-light">{{ row.kana }}</div>
        <div class="ja-shadow-light tw-text-xs tw-capitalize">{{ row.meaning }}</div>
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
