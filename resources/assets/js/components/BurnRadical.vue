<script>
export default {
  props: {
    action: String,
    burned: Number,
  },

  data() {
    return {}
  },

  computed: {
    toggleBurnText: function () {
      return this.burned ? 'Восстановить ключ' : 'Сжечь ключ';
    },
  },

  methods: {
    toggleBurned: function () {
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
