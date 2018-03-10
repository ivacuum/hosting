<script>
import BurnRadical from './BurnRadical.vue'

export default {
  extends: BurnRadical,

  computed: {
    toggleBurnText() {
      return this.burned ? 'Восстановить кандзи' : 'Сжечь кандзи';
    },
  }
}
</script>
