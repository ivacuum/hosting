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
  <div>
    <a class="btn btn-default" :href="resource.new_photo_url">Добавить фотографии</a>
  </div>
  <div class="mt-3" v-if="resource.meta_image">
    <img class="img-fluid rounded" :src="resource.meta_image">
  </div>
  <button class="btn btn-default mt-3" @click.prevent="notify">
    {{ $t('trips.notify') }}
  </button>
</div>
</template>
