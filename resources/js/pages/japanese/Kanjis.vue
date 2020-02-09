<script>
import KanjiList from '../../components/japanese/KanjiList.vue'

export default {
  components: { KanjiList },

  created() {
    document.title = this.$i18n.t('japanese.kanji')
  }
}
</script>

<template>
<div>
  <h1 class="h2">{{ $t('japanese.kanji') }}</h1>
  <kanji-list/>
</div>
</template>
