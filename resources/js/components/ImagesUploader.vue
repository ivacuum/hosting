<template>
  <div>
    <div v-if="!uploading">
      <input
        class="block w-full"
        accept="image/jpeg,image/png"
        type="file"
        name="files[]"
        multiple
        @change="uploadFiles($event.currentTarget.files)"
      >
    </div>
    <div v-else>
      Идет загрузка... {{ uploaded }} из {{ total }}
    </div>

    <div v-if="thumbnails.length" class="my-4">
      <div v-for="thumbnail in thumbnails">
        {{ thumbnail.filename }} ... ok
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['action', 'append'],

  data() {
    return {
      thumbnails: [],
      total: 0,
      uploaded: 0,
      uploading: false,
    }
  },

  methods: {
    uploadFile(file) {
      return new Promise((resolve) => {
        let form = new FormData()

        $(this.append).each((index, item) => {
          form.append(item.name, item.value)
        })

        form.append('file', file)

        axios
          .post(this.action, form)
          .then((response) => {
            this.thumbnails.push(response.data)
            this.uploaded++

            if (this.uploaded === this.total) {
              this.uploading = false
            }

            resolve()
          })
      })
    },

    uploadFiles(files) {
      this.uploading = true
      this.total += files.length

      let chain = Promise.resolve()

      for (let i = 0, length = files.length; i < length; i++) {
        chain = chain.then(() => this.uploadFile(files[i]))
      }
    }
  }
}
</script>
