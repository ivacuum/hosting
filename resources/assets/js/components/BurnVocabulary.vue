<script>
import BurnRadical from './BurnRadical.vue'

export default {
  extends: BurnRadical,

  computed: {
    toggleBurnText: function () {
      return this.burned ? 'Восстановить слово' : 'Сжечь слово';
    },
  }
}
</script>
