<template>
  <div class="youtube-container -mt-4">
    <div v-if="!expanded">
      <p>
        <svg class="svg-icon svg-icon-youtube-play mr-1" viewBox="0 0 16 16"><path d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 010 1.393z"/></svg>
        <a class="pseudo" href="#" @click.prevent="toggle">{{ $t('OPEN_VIDEO', { title }) }}</a>
      </p>
    </div>
    <div v-if="expanded">
      <p>
        <svg class="svg-icon svg-icon-times mr-1" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/><path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/></svg>
        <a class="pseudo" href="#" @click.prevent="toggle">{{ $t('CLOSE_VIDEO', { title }) }}</a>
      </p>
      <div class="-mt-2 mb-6 mobile-wide">
        <iframe
          class="w-full h-full"
          :style="{ height: height() + 'px' }"
          :src="`https://www.youtube.com/embed/${v}?autoplay=1${this.startAt}${this.endAt}`"
          frameborder="0"
          allowfullscreen
        ></iframe>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    end: {
      type: Number,
      default: 0,
    },
    ratio: {
      type: String,
      default: '16/9',
    },
    title: String,
    start: {
      type: Number,
      default: 0,
    },
    v: String,
  },

  data() {
    return {
      expanded: false,
    }
  },

  computed: {
    endAt() {
      return this.end ? `&end=` + Number(this.end) : ''
    },

    startAt() {
      return this.start ? `&start=` + Number(this.start) : ''
    },
  },

  i18n: {
    messages: {
      en: {
        OPEN_VIDEO: 'Open video "{title}"',
        CLOSE_VIDEO: 'Close video "{title}"',
      },
      ru: {
        OPEN_VIDEO: 'Открыть видео «{title}»',
        CLOSE_VIDEO: 'Закрыть видео «{title}»',
      },
    },
  },

  methods: {
    height() {
      const ratio = this.ratio.split('/') // 16/9

      return this.$el.offsetWidth / ratio[0] * ratio[1]
    },

    toggle() {
      this.expanded = !this.expanded
    }
  }
}
</script>
