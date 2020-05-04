<script>
export default {
  inject: ['n'],

  props: {
    hint: {
      type: String,
      default: '',
    },
    answer: {
      type: String,
      required: true,
    },
    answered: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      id: Math.random().toString(36).substring(2, 7),
      input: this.answered ? this.answer : '',
      success: this.answered,
    }
  },

  mounted() {
    if (this.success) this.done()
  },

  computed: {
    lowerAnswer() {
      return this.answer.toLowerCase()
    }
  },

  watch: {
    input(value) {
      // TODO: преобразование апострофов`‘ (или удаление)
      // TODO: преобразование 'll в " will"
      if (value.toLowerCase() === this.lowerAnswer) {
        this.focusOnNextInput()
        this.done()
      }
    },
  },

  methods: {
    focusOnNextInput() {
      const inputs = [...document.querySelectorAll('input:enabled')]
      const current = this.$refs.input
      let found = false

      inputs.some((el) => {
        // Следующая итерация после находки
        if (found) {
          el.focus()
          return true
        }

        if (el.isEqualNode(current)) {
          found = true
        }
      })
    },

    done() {
      this.success = true
      this.$root.$emit(`n${this.n}:answered`, this.answer)
    }
  }
}
</script>

<template>
<span>
  <input
    ref="input"
    lang="en"
    :data-uid="id"
    :disabled="success"
    class="form-input-underline"
    :class="{ 'is-valid': success }"
    :size="Math.max(7, answer.length)"
    autocapitalize="off"
    autocomplete="off"
    autocorrect="off"
    spellcheck="false"
    v-model.trim="input"
  >
  <em v-if="hint">({{ hint }})</em>
</span>
</template>

<style lang="scss">
.form-input-underline {
  border-top: 0;
  border-right: 0;
  /*border-bottom: 1px solid #000;*/
  /*border-bottom: 1px solid #c8c8c8;*/
  border-bottom: 2px dotted #c8c8c8;
  border-left: 0;
  border-radius: 0;
  line-height: 1;
  font-size: 1rem;
  // color: #495057;
  color: #33648c;
  text-align: center;
  padding: 0.175rem 0.5rem;
  max-width: 100%;

  &.is-valid {
    // background-color: #e9ecef;
    background-color: #d4edda;
    // border-color: #28a745;
    border-color: #c3e6cb;
    // color: #000;
    color: #33648c;
  }

  &:disabled { opacity: 1; }
}
</style>
