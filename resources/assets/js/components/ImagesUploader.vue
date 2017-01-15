<template>
  <div>
    <div v-if="!uploading">
      <input required id="userfiles" type="file" name="files[]" multiple min="1" max="1000">
    </div>
    <div v-else>
      Идет загрузка...
    </div>

    <div v-if="thumbnails.length" class="m-y-1">
      <div v-for="thumbnail in thumbnails">
        {{ basename(thumbnail.dest) }} ... ok
        <p v-if="hasCoords(thumbnail)">
          {{ thumbnail.lat }} {{ thumbnail.lon }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
let axios = require('axios')

export default {
  data() {
    return {
      thumbnails: [],
      total: 0,
      uploaded: 0,
      uploading: false,
    }
  },

  mounted() {
    if (window.File == null || window.FileList == null || window.FormData == null) {
      alert('Проблемка. Файлы загрузить не выйдет')
      return false
    }

    $(document).on('change', '#userfiles', (e) => {
      this.uploadFiles(e.currentTarget.files)
    })
  },

  methods: {
    basename(path) {
      return path.split(/[\\/]/).pop()
    },

    hasCoords(thumbnail) {
      return thumbnail.lat && thumbnail.lon
    },

    uploadFile(file) {
      let form = new FormData()

      form.append('files[]', file)

      axios.post('/acp/dev/thumbnails', form).then((response) => {
        const thumbnails = response.data.thumbnails

        for (let i = 0, length = thumbnails.length; i < length; i++) {
          this.thumbnails.push(thumbnails[i])
        }

        this.uploaded++

        if (this.uploaded === this.total) {
          this.uploading = false
        }
      })
    },

    uploadFiles(files) {
      this.uploading = true
      this.total += files.length

      for (let i = 0, length = files.length; i < length; i++) {
        const file = files[i]

        this.uploadFile(file)
      }
    }
  }
}
</script>
