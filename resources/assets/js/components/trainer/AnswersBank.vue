<script>
export default {
  inject: ['n'],

  props: {
    bank: { type: Array, required: true },
  },

  data() {
    return {
      answers: this.bank.map((el) => {
        const [key, answer] = el.split('/')

        return { key, answer: answer || key, used: false }
      }),
    }
  },

  mounted() {
    this.$root.$on(`n${this.n}:answered`, (answer) => {
      this.lineThrough(answer)
    })
  },

  methods: {
    lineThrough(answer) {
      this.answers.find(el => el.answer === answer).used = true
    }
  }
}
</script>

<template>
<div class="d-flex flex-wrap tw-mb-4 text-success">
  <template v-for="answer in answers">
    <span class="mr-3" :class="{ 'bank-used': answer.used }">{{ answer.key }}</span>
  </template>
</div>
</template>
