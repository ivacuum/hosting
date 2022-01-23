<template>
  <div>
    <div class="flex items-center mb-4" v-if="avatar">
      <img class="w-24 h-24 mr-6 rounded-full" :src="avatar" alt="">
      <div>
        <button class="btn btn-default" @click="deleteAvatar">{{ $t('DELETE_AVATAR') }}</button>
      </div>
    </div>
    <div class="mb-4" v-else>
      <slot/>
    </div>
    <div class="mb-4" v-if="errors.file && errors.file.length">
      <div v-for="error in errors.file">
        <div class="text-red-600">{{ error }}</div>
      </div>
    </div>
    <div v-if="!uploading">
      <input
        class="block text-muted w-full file:px-4 file:py-1 file:rounded file:border-0 file:bg-blueish-700 file:text-white hover:file:bg-blueish-800"
        accept="image/jpeg,image/png"
        type="file"
        name="file"
        @change="upload($event.currentTarget.files[0])"
      >
      <div class="form-help">{{ $t('HELP_TEXT') }}</div>
    </div>
    <div v-else>
      {{ $t('LOADING') }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['currentAvatar', 'deleteAction', 'updateAction'],

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
        DELETE_AVATAR: 'Delete avatar',
      },
      ru: {
        LOADING: 'Идет загрузка...',
        HELP_TEXT: 'Аватар сохраняется автоматически после выбора',
        CHOOSE_FILE: 'Выберите файл...',
        DELETE_AVATAR: 'Удалить аватар',
      },
    },
  },

  mounted() {
    this.avatar = this.currentAvatar
  },

  methods: {
    deleteAvatar() {
      this.errors = []
      this.uploading = true

      axios
        .delete(this.deleteAction)
        .then(() => {
          this.avatar = ''
          this.uploading = false
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors
            this.uploading = false
          }
        })
    },

    upload(file) {
      this.errors = []
      this.uploading = true

      let form = new FormData()

      form.append('file', file)
      form.append('_method', 'put')

      axios
        .post(this.updateAction, form)
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
