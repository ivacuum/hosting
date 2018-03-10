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
      return this.burned ? 'Восстановить ключ' : 'Сжечь ключ';
    },
  },

  methods: {
    toggleBurned() {
      if (this.burned) {
        axios.put(this.action)
          .then((response) => {
            if (response.data.status === 'OK') {
              this.burned = 0
            }
          })
      } else {
        axios.delete(this.action)
          .then((response) => {
            if (response.data.status === 'OK') {
              this.burned = 1
            }
          })
      }
    }
  }
}
</script>
