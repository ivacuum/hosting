<script>
export default {
  props: {
    resource: {
      type: Object,
      required: true,
    },
  },
}
</script>

<template>
<div v-if="resource">
  <div class="pre-line">{{ resource.text }}</div>
</div>
</template>
