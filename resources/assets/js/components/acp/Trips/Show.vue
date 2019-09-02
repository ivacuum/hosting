<script>
export default {
  data() {
    return {
      date: null,
    }
  },

  props: {
    resource: {
      type: Object,
      required: true,
    },
  },

  created() {
    this.date = this.calculatePlaceholderDate()
  },

  methods: {
    calculatePlaceholderDate() {
      let date = new Date()

      date.setUTCHours(20, 30, 0, 0)
      date.setDate(date.getDate() + 2)

      return date.toISOString().replace(/\.000Z/, '')
    },

    notify() {
      axios
        .post(`${this.resource.show_url}/notify`, { date: this.date })
        .then(({ data }) => {
          if (data.status === 'OK') {
            notie.alert({ text: data.message })
            return
          }

          notie.alert({ type: 'error', text: data.message })
        })
    },
  }
}
</script>

<template>
<div v-if="resource">
  <div>
    <a class="btn btn-default" :href="resource.new_photo_url">Добавить фотографии</a>
  </div>
  <div class="mt-4" v-if="resource.meta_image">
    <img class="max-w-full h-auto rounded" :src="resource.meta_image">
  </div>
  <div class="flex w-full mt-4">
    <input
      required
      class="form-control rounded-r-none"
      type="datetime-local"
      name="date"
      v-model="date"
    >
    <button
      class="btn btn-default -ml-px rounded-l-none"
      @click.prevent="notify"
      :title="$t('trips.notify')"
      v-html="$root.svg.bell"
    ></button>
  </div>
</div>
</template>
