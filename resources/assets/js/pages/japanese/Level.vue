<script>
import KanjiList from '../../components/japanese/KanjiList.vue'
import RadicalList from '../../components/japanese/RadicalList.vue'
import VocabularyList from '../../components/japanese/VocabularyList.vue'

export default {
  components: {
    KanjiList,
    RadicalList,
    VocabularyList,
  },

  props: {
    level: {
      type: Number,
      required: true,
    },
  },

  created() {
    this.updateMetaTitle()
  },

  beforeRouteUpdate(to, from, next) {
    this.level = to.params.level
    this.updateMetaTitle()
    next()
  },

  methods: {
    updateMetaTitle() {
      document.title = this.$i18n.t('japanese.level', { level: this.level })
    }
  }
}
</script>

<template>
<div>
  <h1 class="h2">{{ $t('japanese.level', { level }) }}</h1>
  <radical-list :key="level" :level="level"/>
  <kanji-list :key="level" :level="level"/>
  <vocabulary-list :key="level" :level="level"/>

  <div class="d-flex justify-content-between mt-3">
    <div>
      <router-link class="btn border-b125" :to="{ name: 'wk.level', params: { level: this.level - 1 }}" v-if="level > 1">
        <span v-html="$root.svg.chevron_left"></span>
        {{ $t('japanese.level', { level: level - 1 }) }}
      </router-link>
    </div>
    <div>
      <router-link class="btn border-b125" :to="{ name: 'wk.level', params: { level: this.level + 1 }}" v-if="level < 60">
        {{ $t('japanese.level', { level: level + 1 }) }}
        <span v-html="$root.svg.chevron_right"></span>
      </router-link>
    </div>
  </div>
</div>
</template>
