<script>
import BurnRadical from './BurnRadical.vue'

export default {
  extends: BurnRadical,

  data() {
    return {
      section: 'vocabulary',
    }
  },

  i18n: {
    messages: {
      en: {
        BURN: 'Burn this vocabulary',
        RESTORE: 'Restore',
      },
      ru: {
        BURN: 'Сжечь слово',
        RESTORE: 'Восстановить',
      },
    }
  },
}
</script>
