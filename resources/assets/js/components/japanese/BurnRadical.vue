<script>
import locale from '../../i18n/locale'

export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
    burned: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      section: 'radicals',
    }
  },

  computed: {
    toggleBurnText() {
      return this.$i18n.t(this.burned ? 'RESTORE' : 'BURN')
    },
  },

  i18n: {
    messages: {
      en: {
        BURN: 'Burn this key',
        RESTORE: 'Restore',
      },
      ru: {
        BURN: 'Сжечь ключ',
        RESTORE: 'Восстановить',
      },
    }
  },

  methods: {
    toggleBurned() {
      const action = `${locale}/japanese/wanikani/${this.section}/${this.id}`

      if (this.burned) {
        axios
          .put(action)
          .then(({ data }) => {
            if (data.status === 'OK') {
              this.burned = 0
            }
          })
      } else {
        axios
          .delete(action)
          .then(({ data }) => {
            if (data.status === 'OK') {
              this.burned = 1
            }
          })
      }
    }
  }
}
</script>

<template>
<div>
  <button class="btn btn-default" type="button" @click="toggleBurned">{{ toggleBurnText }}</button>
</div>
</template>
