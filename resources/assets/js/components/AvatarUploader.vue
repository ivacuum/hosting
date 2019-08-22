<template>
<div>
  <div class="tw-mb-4" v-if="avatar">
    <img class="avatar-100 rounded-circle" :src="avatar">
  </div>
  <div class="tw-mb-4" v-if="errors.file && errors.file.length">
    <div v-for="error in errors.file">
      <div class="tw-text-red-600">{{ error }}</div>
    </div>
  </div>
  <div v-if="!uploading">
    <div class="custom-file">
      <input
        class="custom-file-input"
        accept="image/jpeg,image/png"
        type="file"
        name="file"
        @change="upload($event.currentTarget.files[0])">
      <label class="custom-file-label">{{ $t('CHOOSE_FILE') }}</label>
    </div>
    <div class="form-help">{{ $t('HELP_TEXT') }}</div>
  </div>
  <div v-else>
    {{ $t('LOADING') }}
  </div>
</div>
</template>

<script>
export default {
  props: ['action', 'currentAvatar'],

  data() {
    return {
      avatar: '',
      errors: [],
      uploading: false,
    }
  },

  i18n: {
    messages: {
      en: {
        LOADING: 'Loading...',
        HELP_TEXT: 'Avatar would be saved automatically after selection is made',
        CHOOSE_FILE: 'Choose file...',
      },
      ru: {
        LOADING: 'Идет загрузка...',
        HELP_TEXT: 'Аватар сохраняется автоматически после выбора',
        CHOOSE_FILE: 'Выберите файл...',
      },
    },
  },

  mounted() {
    this.avatar = this.currentAvatar
  },

  methods: {
    upload(file) {
      this.errors = []
      this.uploading = true

      let form = new FormData()

      form.append('file', file)
      form.append('_method', 'put')

      axios
        .post(this.action, form)
        .then((response) => {
          this.avatar = response.data.avatar
          this.uploading = false
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors
            this.uploading = false
          }
        })
    },
  }
}
</script>
