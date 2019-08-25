<script>
export default {
  props: {
    resource: {
      type: Object,
      required: true,
    },
  },

  methods: {
    notify() {
      axios
        .post(`${this.resource.show_url}/notify`)
        .then(({ data }) => {
          if (data.status === 'OK') {
            notie.alert({ text: data.message })
            return
          }

          notie.alert({ type: 'error', text: data.message })
        })
    }
  }
}
</script>

<template>
<div v-if="resource">
  <div class="mt-4" v-if="resource.meta_image">
    <img class="max-w-full h-auto rounded image-fit-viewport" :src="resource.meta_image">
  </div>
  <button class="btn btn-default mt-4" @click.prevent="notify">
    {{ $t('trips.notify') }}
  </button>
</div>
</template>
