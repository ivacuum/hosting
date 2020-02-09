import * as types from '../store/mutation-types'
import ListHeader from '../components/acp/ListHeader.vue'
import Pagination from '../components/acp/Pagination.vue'
import SortableHeader from '../components/acp/SortableHeader.vue'
import acpRequestErrorNotification from '../utils/acpRequestErrorNotification'

export default {
  components: {
    ListHeader,
    Pagination,
    SortableHeader,
  },

  data() {
    return {
      selected: [],
      collection: {},
    }
  },

  computed: {
    addition() {
      return (this.collection.meta.current_page - 1) * this.collection.meta.per_page
    },

    loaded() {
      return Object.keys(this.collection).length
    },

    selectAll: {
      get() {
        return this.selected.length === this.collection.data.length
      },

      set(value) {
        if (value === false) {
          this.selected = []
          return
        }

        const selected = []

        this.collection.data.forEach((resource) => {
          selected.push(resource.id)
        })

        this.selected = selected
      },
    },
  },

  beforeRouteEnter(to, from, next) {
    axios
      .get(to.fullPath)
      .then(({ data }) => {
        next((vm) => {
          vm.collection = data
          vm.$store.commit(types.BREADCRUMBS_SET, data.breadcrumbs)
        })
      })
  },

  // Активируется, например, при фильтрации
  beforeRouteUpdate(to, from, next) {
    axios
      .get(to.fullPath)
      .then(({ data }) => {
        this.collection = data
        this.$store.commit(types.BREADCRUMBS_SET, data.breadcrumbs)
        next()
      })
  },

  methods: {
    batch(action) {
      axios
        .post(`${this.$route.path}/batch`, { action, selected: this.selected })
        .then((response) => {
          axios
            .get(this.$route.fullPath)
            .then(({ data }) => {
              this.collection = data
              this.selected = []
              $.scrollTo(document.body, 300, { axis: 'y' })
            })

          notie.alert({ text: response.data.message })
        })
        .catch(acpRequestErrorNotification)
    },

    search(q) {
      this.$router.push({
        query: {
          ...this.$route.query,
          page: undefined,
          q,
        },
      })
    },
  },
}
