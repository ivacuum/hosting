<script>
import BurnRadical from './BurnRadical.vue'

export default {
  extends: BurnRadical,

  data() {
    return {
      section: 'kanji',
    }
  },

  i18n: {
    messages: {
      en: {
        BURN: 'Burn this kanji',
        RESTORE: 'Restore',
      },
      ru: {
        BURN: 'Сжечь кандзи',
        RESTORE: 'Восстановить',
      },
    }
  },
}
</script>
