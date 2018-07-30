<script>
import FormText from '../forms/FormInputText.vue'
import FormRadio from '../forms/FormInputRadio.vue'
import FormSelect from '../forms/FormInputSelect.vue'
import acpResourceUrl from '../../utils/acpResourceUrl'
import StickyBottomButtons from './StickyBottomButtons.vue'
import acpRequestErrorNotification from '../../utils/acpRequestErrorNotification'

export default {
  components: {
    FormText,
    FormRadio,
    FormSelect,
    StickyBottomButtons,
  },

  props: {
    resource: Object,
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

    catchFormError(error) {
      if (!error.response) return

      if (error.response.status === 422) {
        this.$store.commit('setValidationErrors', error.response.data.errors)

        if (error.response.data.errors._concurrency_control) {
          notie.alert({
            type: 'error',
            text: error.response.data.errors._concurrency_control[0],
            stay: true,
          })
          return
        }

        notie.alert({ type: 'error', text: this.$i18n.t('check_form_data') })
        return
      }

      acpRequestErrorNotification(error)
    },

    payload(put = false) {
      const payload = new FormData(this.$refs.form)

      if (put) payload.append('_method', 'put')

      return payload
    },

    store(addAnother = false) {
      this.saving = true

      axios
        .post(acpResourceUrl(this.$route.path), this.payload())
        .then((response) => {
          this.$store.commit('clearValidationErrors')

          if (response.status === 201) {
            if (addAnother) {
              notie.alert({ text: this.$i18n.t('changes_saved') })
            } else {
              this.$router.push(response.headers.location)
            }
          }
        })
        .catch(this.catchFormError)
        .then(() => {
          this.saving = false
        })
    },

    storeAndAddAnother() {
      return this.store(true)
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

          if (response.status === 200 && redirect) {
            this.$router.back()
          } else {
            if (response.data._concurrency_control) {
              this.extra._concurrency_control = response.data._concurrency_control
            }

            notie.alert({ text: this.$i18n.t('changes_saved') })
          }
        })
        .catch(this.catchFormError)
        .then(() => {
          this.saving = false
        })
    },
  },

  destroyed() {
    this.$store.commit('clearValidationErrors')
  }
}
</script>
