<template>
  <div>
    <button class="btn btn-default" @click="toggleBurned">{{ toggleBurnText }}</button>
  </div>
</template>

<script>
export default {
  props: {
    action: String,
    burned: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {}
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
      if (this.burned) {
        axios
          .put(this.action)
          .then(({ data }) => {
            if (data.status === 'OK') {
              this.burned = 0
            }
          })
      } else {
        axios
          .delete(this.action)
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
