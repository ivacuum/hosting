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
          <button class="btn btn-default">
            <svg class="svg-icon svg-icon-search" viewBox="0 0 16 16" width="16" height="16"><path d="M15.7 13.3l-3.81-3.83A5.93 5.93 0 0 0 13 6c0-3.31-2.69-6-6-6S1 2.69 1 6s2.69 6 6 6c1.3 0 2.48-.41 3.47-1.11l3.83 3.81c.19.2.45.3.7.3.25 0 .52-.09.7-.3a.996.996 0 0 0 0-1.41v.01zM7 10.7c-2.59 0-4.7-2.11-4.7-4.7 0-2.59 2.11-4.7 4.7-4.7 2.59 0 4.7 2.11 4.7 4.7 0 2.59-2.11 4.7-4.7 4.7z"/></svg>
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="my-3" v-if="Object.keys(elements).length">
    <a
      class="align-items-center bg-radical border-radical d-flex justify-content-between px-2 px-sm-3 py-2 text-white"
      :href="row.slug"
      v-for="row in elements.radicals"
    >
      <div class="flex-shrink-0" v-if="row.image">
        <img class="ja-character ja-image-shadow" :src="row.image" alt="" height="36">
      </div>
      <div class="f36 flex-shrink-0 font-weight-bold ja-character ja-shadow pb-1 text-nowrap" v-else>{{ row.character }}</div>
      <div class="flex-grow-1 ja-shadow-light small text-capitalize text-right">{{ row.meaning }}</div>
    </a>

    <a
      class="align-items-center bg-kanji border-kanji d-flex justify-content-between px-2 px-sm-3 py-2 text-white"
      :href="row.slug"
      v-for="row in elements.kanji"
    >
      <div class="f36 flex-shrink-0 font-weight-bold ja-character ja-shadow pb-1 text-nowrap">{{ row.character }}</div>
      <div class="flex-grow-1 text-right">
        <div class="font-weight-bold ja-shadow-light">{{ row.reading }}</div>
        <div class="ja-shadow-light small text-capitalize">{{ row.meaning }}</div>
      </div>
    </a>

    <a
      class="align-items-center bg-vocab border-vocab d-flex justify-content-between px-2 px-sm-3 py-2 text-white"
      :href="row.slug"
      v-for="row in elements.vocabulary"
    >
      <div class="f36 flex-shrink-0 font-weight-bold ja-character ja-shadow pb-1 text-nowrap">{{ row.character }}</div>
      <div class="flex-grow-1 text-right">
        <div class="font-weight-bold ja-shadow-light">{{ row.kana }}</div>
        <div class="ja-shadow-light small text-capitalize">{{ row.meaning }}</div>
      </div>
    </a>
  </div>
</div>
</template>

<script>
export default {
  props: ['action'],

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
      },
      ru: {
        CLEAR: 'Очистить',
        SEARCH: 'Поиск...',
        RESULTS: 'Результатов: {results}',
      },
    },
  },

  methods: {
    onSubmit() {
      axios
        .post(this.action, { q: this.q })
        .then((response) => {
          this.results = Number(response.data.count)
          this.elements = response.data
        })
    },

    reset() {
      this.results = 0
      this.elements = []
    }
  }
}
</script>
