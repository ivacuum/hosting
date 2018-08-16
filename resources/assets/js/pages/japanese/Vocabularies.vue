<script>
import VocabularyList from '../../components/japanese/VocabularyList.vue'

export default {
  components: { VocabularyList },

  created() {
    document.title = this.$i18n.t('japanese.vocabulary')
  }
}
</script>

<template>
<div>
  <h1 class="h2">{{ $t('japanese.vocabulary') }}</h1>
  <vocabulary-list/>
</div>
</template>
