<template>
<div>
  <div class="mb-4" v-if="errors.file && errors.file.length">
    <div v-for="error in errors.file">
      <div class="text-red-600">{{ error }}</div>
    </div>
  </div>
  <div v-if="!uploading">
    <div class="custom-file max-w-400px">
      <input
        class="custom-file-input"
        accept="image/gif,image/jpeg,image/png"
        type="file"
        name="files[]"
        multiple
        :max="max"
        @change="uploadFiles($event.currentTarget.files)">
      <label class="custom-file-label">{{ $t('CHOOSE_FILES') }}</label>
    </div>
    <div class="form-help">{{ $t('HELP_TEXT') }}</div>
  </div>
  <div v-else>
    Идет загрузка... {{ uploaded }} из {{ total }}
  </div>

  <div v-if="files.length" class="my-6">
    <div v-if="files.length > 1">
      <h3>Ссылки на все картинки</h3>
      <div class="md:flex md:-mx-4">
        <div class="md:w-2/3 md:px-4">
          <div>Ссылка:</div>
          <textarea class="form-control select-all" :rows="total" v-html="links"></textarea>
          <div class="mt-2">Полная картинка:</div>
          <input class="form-control select-all" :value="linksInTag">
        </div>
      </div>
      <h3 class="mt-12">Индивидуальные ссылки</h3>
    </div>
    <div v-for="file in files">
      <div class="md:flex md:-mx-4 mt-4">
        <div class="md:w-1/6 md:px-4 text-center mt-2 mb-4">
          <img class="inline-block screenshot" :src="file.thumbnail">
        </div>
        <div class="md:w-1/2 md:px-4">
          <div>Ссылка:</div>
          <input class="form-control select-all" :value="file.original">
          <div class="mt-2">Полная картинка:</div>
          <input class="form-control select-all" :value="`[img]${file.original}[/img]`">
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
      files: [],
      total: 0,
      errors: [],
      uploaded: 0,
      uploading: false
    }
  },

  i18n: {
    messages: {
      en: {
        HELP_TEXT: 'You can select files in pop-up window or drag&drop them on form element',
        CHOOSE_FILES: 'Choose files...',
      },
      ru: {
        HELP_TEXT: 'Файлы можно выбрать в появившемся окне или перетащить прямо на элемент выбора',
        CHOOSE_FILES: 'Выберите файлы...',
      },
    },
  },

  computed: {
    links() {
      let originals = []

      this.files.forEach(file => originals.push(file.original))

      return originals.join('&#10')
    },

    linksInTag() {
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
      return new Promise((resolve, reject) => {
        let form = new FormData()

        form.append('file', file)

        axios
          .post(this.action, form)
          .then((response) => {
            this.files.push(response.data)
            this.incrementUploaded()

            resolve()
          })
          .catch((error) => {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.errors
              this.incrementUploaded()
            } else if (error.response && error.response.status === 500) {
              alert('Загрузка временно недоступна. Попробуйте повторить попытку позднее')
              this.incrementUploaded()
            }

            reject(error)
          })
      })
    },

    uploadFiles(files) {
      this.uploading = true
      this.errors = []
      this.total += files.length

      let chain = Promise.resolve()

      for (let i = 0, length = files.length; i < length; i++) {
        chain = chain.then(() => this.uploadFile(files[i]))
      }
    }
  }
}
</script>