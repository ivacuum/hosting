<template>
  <div class="youtube-container">
    <div v-if="!expanded">
      <p>
        <svg class="svg-icon svg-icon-youtube-play mr-1" viewBox="0 0 1792 1792"><path d="M1280 896q0-37-30-54l-512-320q-31-20-65-2-33 18-33 56v640q0 38 33 56 16 8 31 8 20 0 34-10l512-320q30-17 30-54zm512 0q0 96-1 150t-8.5 136.5-22.5 147.5q-16 73-69 123t-124 58q-222 25-671 25t-671-25q-71-8-124.5-58t-69.5-123q-14-65-21.5-147.5t-8.5-136.5-1-150 1-150 8.5-136.5 22.5-147.5q16-73 69-123t124-58q222-25 671-25t671 25q71 8 124.5 58t69.5 123q14 65 21.5 147.5t8.5 136.5 1 150z"/></svg>
        <a class="pseudo" href="#" @click.prevent="expand">
          {{ title }}
        </a>
      </p>
    </div>
    <div v-if="expanded">
      <p>
        <svg class="svg-icon svg-icon-times mr-1" viewBox="0 0 1792 1792"><path d="M1490 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z"/></svg>
        <a class="pseudo" href="#" @click.prevent="collapse">
        <span v-if="lang === 'ru'">
          Закрыть видео «{{ title }}»
        </span>
          <span v-if="lang === 'en'">
          Close video "{{ title }}"
        </span>
        </a>
      </p>
      <div class="pic-container">
        <iframe class="youtube-video" :style="{ height: height() + 'px' }" :src="`https://www.youtube.com/embed/${v}?autoplay=1`" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    ratio: {
      type: String,
      default: '16/9',
    },
    title: String,
    v: String,
  },

  data() {
    return {
      expanded: false,
      lang: '',
    }
  },

  mounted() {
    this.lang = window['AppOptions'].locale
  },

  methods: {
    collapse() {
      this.expanded = false
    },

    expand() {
      this.expanded = true
    },

    height() {
      const ratio = this.ratio.split('/') // 16/9

      return this.$el.offsetWidth / ratio[0] * ratio[1]
    }
  }
}
</script>
