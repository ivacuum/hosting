<template>
  <div class="youtube-container tw--mt-4">
    <div v-if="!expanded">
      <p>
        <svg class="svg-icon svg-icon-youtube-play svg-18 tw-mr-1" viewBox="0 0 576 512" width="18" height="16"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>
        <a class="pseudo" href="#" @click.prevent="toggle">{{ $t('OPEN_VIDEO', { title }) }}</a>
      </p>
    </div>
    <div v-if="expanded">
      <p>
        <svg class="svg-icon svg-icon-times tw-mr-1" viewBox="0 0 12 16" width="16" height="16"><path d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
        <a class="pseudo" href="#" @click.prevent="toggle">{{ $t('CLOSE_VIDEO', { title }) }}</a>
      </p>
      <div class="tw--mt-2 tw-mb-6 tw-mobile-wide">
        <iframe
          class="youtube-video"
          :style="{ height: height() + 'px' }"
          :src="`https://www.youtube.com/embed/${v}?autoplay=1`"
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
    }
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
