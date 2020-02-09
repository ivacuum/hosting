<script>
export default {
  props: {
    n: {
      type: Number,
      required: true,
    },
  },

  provide() {
    return {
      n: this.n,
    }
  },
}
</script>

<template>
<section>
  <h4>
    <span class="ex-number">{{ n }}</span>
    <span class="ex-title"><slot name="title"/></span>
  </h4>
  <slot/>
</section>
</template>
