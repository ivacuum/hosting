<template>
<div>
  <div class="mb-3" v-if="avatar">
    <img class="avatar-100 rounded-circle" :src="avatar">
  </div>
  <div class="mb-3" v-if="errors.file && errors.file.length">
    <div v-for="error in errors.file">
      <div class="text-danger">{{ error }}</div>
    </div>
  </div>
  <div v-if="!uploading">
    <div class="custom-file">
      <input class="custom-file-input"
             accept="image/jpeg,image/png"
             type="file"
             name="file"
             @change="upload($event.currentTarget.files[0])">
      <label class="custom-file-label">Выберите файл...</label>
    </div>
    <div class="form-help">Аватар сохраняется автоматически после выбора</div>
  </div>
  <div v-else>
    Идет загрузка...
  </div>
</div>
</template>

<script>
export default {
  props: ['action', 'current_avatar'],

  data() {
    return {
      avatar: '',
      errors: [],
      uploading: false,
    }
  },

  mounted() {
    this.avatar = this.current_avatar

    if (window.File == null || window.FileList == null || window.FormData == null) {
      alert('Проблемка. Файлы загрузить не выйдет')
      return false
    }
  },

  methods: {
    upload(file) {
      this.errors = []
      this.uploading = true

      let form = new FormData()

      form.append('file', file)
      form.append('_method', 'put')

      axios.post(this.action, form).then((response) => {
        this.avatar = response.data.avatar
        this.uploading = false
      }).catch((error) => {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data
          this.uploading = false
        }
      })
    },
  }
}
</script>
