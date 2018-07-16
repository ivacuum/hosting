import ListHeader from '../components/acp/ListHeader.vue'
import Pagination from '../components/acp/Pagination.vue'
import SortableHeader from '../components/acp/SortableHeader.vue'

export default {
  components: {
    ListHeader,
    Pagination,
    SortableHeader,
  },

  data() {
    return {
      collection: {},
    }
  },

  computed: {
    loaded() {
      return Object.keys(this.collection).length
    },
  },

  beforeRouteEnter(to, from, next) {
    axios
      .get(to.fullPath)
      .then(({ data }) => {
        next((vm) => {
          vm.collection = data
          vm.$store.commit('setBreadcrumbs', data.breadcrumbs)
        })
      })
  },

  // Активируется, например, при фильтрации
  beforeRouteUpdate(to, from, next) {
    axios
      .get(to.fullPath)
      .then(({ data }) => {
        this.collection = data
        this.$store.commit('setBreadcrumbs', data.breadcrumbs)
        next()
      })
  },
}
