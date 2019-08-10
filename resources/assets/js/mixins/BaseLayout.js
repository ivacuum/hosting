import * as types from '../store/mutation-types'
import acpResourceUrl from '../utils/acpResourceUrl'
import acpRequestErrorNotification from '../utils/acpRequestErrorNotification'

export default {
  data() {
    return {
      extra: {},
      resource: {},
    }
  },

  beforeRouteEnter(to, from, next) {
    const path = acpResourceUrl(to.path, true)

    axios
      .get(path)
      .then((response) => {
        next((vm) => {
          const { data, ...extra } = response.data

          vm.resource = data
          vm.extra = extra
          vm.$store.commit(types.BREADCRUMBS_SET, extra.breadcrumbs)
        })
      })
  },

  beforeRouteUpdate(to, from, next) {
    // if (to.params.id === from.params.id) return next()

    axios
      .get(acpResourceUrl(to.path, true))
      .then(({ data }) => {
        this.resource = data.data
        this.$store.commit(types.BREADCRUMBS_SET, data.breadcrumbs)
        next()
      })
  },

  methods: {
    destroy() {
      notie.confirm({
        text: this.$i18n.t('delete_confirmation'),
        submitText: this.$i18n.t('yes'),
        cancelText: this.$i18n.t('cancel'),
        submitCallback: () => {
          axios
            .delete(this.resource.show_url)
            .then((response) => {
              if (response.data.status === 'OK') {
                this.$router.push(response.data.redirect)
              }
            })
            .catch(acpRequestErrorNotification)
        },
      })
    },
  },
}
