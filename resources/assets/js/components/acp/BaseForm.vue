<script>
import FormText from '../forms/FormInputText.vue'
import FormRadio from '../forms/FormInputRadio.vue'
import FormSelect from '../forms/FormInputSelect.vue'
import acpResourceUrl from '../../utils/acpResourceUrl'
import StickyBottomButtons from './StickyBottomButtons.vue'

export default {
  components: {
    FormText,
    FormRadio,
    FormSelect,
    StickyBottomButtons,
  },

  data() {
    return {
      mode: 'new',
      extra: {},
      model: {},
      saving: false,
    }
  },

  beforeRouteEnter(to, from, next) {
    axios
      .get(to.fullPath)
      .then(({ data }) => {
        next((vm) => {
          if (to.params.id) {
            vm.mode = 'edit'
          }

          const { breadcrumbs, model, ...extra } = data

          vm.extra = extra
          vm.model = model

          vm.$store.commit('setBreadcrumbs', breadcrumbs)
        })
      })
  },

  computed: {
    createTitle() {
      return this.$i18n.t(`${this.modelPlural}.create`)
    },

    isEditing() {
      return this.mode === 'edit'
    }
  },

  methods: {
    apply() {
      return this.update(false)
    },

    payload(put = false) {
      const payload = new FormData(this.$refs.form)

      if (put) payload.append('_method', 'put')

      return payload
    },

    store() {
      this.saving = true

      axios
        .post(acpResourceUrl(this.$route.path), this.payload())
        .then((response) => {
          this.$store.commit('clearValidationErrors')

          if (response.status === 201) {
            this.$router.push(response.headers.location)
          }
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.$store.commit('setValidationErrors', error.response.data.errors)
          }

          // console.log(`${error.response.status} ${error.response.statusText}`)
        })
        .finally(() => {
          this.saving = false
        })
    },

    submit() {
      return this.isEditing ? this.update() : this.store()
    },

    update(redirect = true) {
      this.saving = true

      axios
        .post(acpResourceUrl(this.$route.path, true), this.payload(true))
        .then((response) => {
          this.$store.commit('clearValidationErrors')

          if (response.status === 204 && redirect) {
            this.$router.back()
          }
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.$store.commit('setValidationErrors', error.response.data.errors)
          }

          // console.log(`${error.response.status} ${error.response.statusText}`)
        })
        .finally(() => {
          this.saving = false
        })
    },
  },

  destroyed() {
    this.$store.commit('clearValidationErrors')
  }
}
</script>
