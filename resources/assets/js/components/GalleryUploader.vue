<template>
<div>
  <div class="mb-3" v-if="errors.file && errors.file.length">
    <div v-for="error in errors.file">
      <div class="text-danger">{{ error }}</div>
    </div>
  </div>
  <div v-if="!uploading">
    <label class="custom-file">
      <input class="custom-file-input"
             accept="image/gif,image/jpeg,image/png"
             type="file"
             name="files[]"
             multiple
             :max="max"
             @change="uploadFiles($event.currentTarget.files)">
      <span class="custom-file-control custom-file-multiple-control"></span>
    </label>
    <span class="help-block">Файлы можно выбрать в появившемся окне или перетащить прямо на элемент выбора</span>
  </div>
  <div v-else>
    Идет загрузка... {{ uploaded }} из {{ total }}
  </div>

  <div v-if="files.length" class="my-4">
    <div v-if="files.length > 1">
      <h3>Ссылки на все картинки</h3>
      <div class="row">
        <div class="col-md-8">
          <div>Ссылка:</div>
          <textarea class="form-control js-highlight" :rows="total" v-html="links"></textarea>
          <div class="mt-2">Полная картинка:</div>
          <input class="form-control js-highlight" type="text" :value="linksInTag">
        </div>
      </div>
      <h3 class="mt-5">Индивидуальные ссылки</h3>
    </div>
    <div v-for="file in files">
      <div class="row mt-3">
        <div class="col-md-2 text-center mt-2 mb-3">
          <img class="screenshot" :src="file.thumbnail">
        </div>
        <div class="col-md-6">
          <div>Ссылка:</div>
          <input class="form-control js-highlight" type="text" :value="file.original">
          <div class="mt-2">Полная картинка:</div>
          <input class="form-control js-highlight" type="text" :value="`[img]${file.original}[/img]`">
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['action', 'max'],

  data() {
    return {
      errors: [],
      files: [],
      total: 0,
      uploaded: 0,
      uploading: false
    }
  },

  mounted() {
    if (window.File == null || window.FileList == null || window.FormData == null) {
      alert('Проблемка. Файлы загрузить не выйдет')
      return false
    }
  },

  computed: {
    links: function() {
      let originals = []

      this.files.forEach(file => originals.push(file.original))

      return originals.join('&#10')
    },

    linksInTag: function() {
      let originals = []

      this.files.forEach(file => originals.push(`[img]${file.original}[/img]`))

      return originals.join(' ')
    },
  },

  methods: {
    incrementUploaded() {
      this.uploaded++

      if (this.uploaded === this.total) {
        this.uploading = false
      }
    },

    uploadFile(file) {
      let form = new FormData()

      form.append('file', file)

      axios.post(this.action, form).then((response) => {
        this.files.push(response.data)
        this.incrementUploaded()
      }).catch((error) => {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data
          this.incrementUploaded()
        }
      })
    },

    uploadFiles(files) {
      this.uploading = true
      this.errors = []
      this.total += files.length

      for (let i = 0, length = files.length; i < length; i++) {
        this.uploadFile(files[i])
      }
    }
  }
}
</script>
