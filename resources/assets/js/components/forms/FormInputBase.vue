<script>
import ModelFieldTrans from '../../mixins/ModelFieldTrans'

export default {
  inject: ['modelSingular'],
  mixins: [ModelFieldTrans],

  props: {
    help: {
      type: String,
      default: null,
    },
    name: {
      type: String,
      required: true,
    },
    type: {
      type: String,
      default: 'text',
    },
    label: {
      type: String,
      default: null,
    },
    value: {
      default: null,
    },
    options: {
      type: Array,
      default: [],
    },
    required: {
      type: Boolean,
      default: false,
    },
    placeholder: {
      type: String,
      default: null,
    },
  },

  computed: {
    errors() {
      return this.$store.state.global.validationErrors[this.name]
    },

    inputClasses() {
      return {
        'is-invalid': this.errors,
      }
    },

    labelClasses() {
      return {
        'col-form-label': this.type !== 'checkbox' && this.type !== 'radio',
        'input-required': this.required,
      }
    },

    labelText() {
      return this.label ? this.label : this.modelFieldTrans(this.name)
    }
  }
}
</script>
