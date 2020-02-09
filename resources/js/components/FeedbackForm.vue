<script>
export default {
  props: {
    name: {
      type: String,
      default: '',
    },
    email: {
      type: String,
      default: '',
    },
    title: {
      type: String,
      default: '',
    },
    action: {
      type: String,
      required: true,
    },
    hideName: {
      type: Boolean,
      default: false,
    },
    hideTitle: {
      type: Boolean,
      default: false,
    },
    submitText: {
      type: String,
      default() {
        return this.$i18n.t('SUBMIT_TEXT')
      },
    },
    successText: {
      type: String,
      default() {
        return this.$i18n.t('SUCCESS_TEXT')
      },
    },
    textareaLabel: {
      type: String,
      default() {
        return this.$i18n.t('TEXT_LABEL')
      }
    },
  },

  data() {
    return {
      text: '',
      trap: '',
      isMobile: document.body.matches('.is-mobile'),
      localName: this.name,
      localEmail: this.email,
      localTitle: this.title,
    }
  },

  computed: {
    filled() {
      return this.text && this.localEmail && (this.localName || this.hideName) && (this.localTitle || this.hideTitle)
    }
  },

  i18n: {
    messages: {
      en: {
        NAME_LABEL: 'Your name',
        TEXT_LABEL: 'Your message',
        EMAIL_LABEL: 'E-mail',
        TITLE_LABEL: 'Subject',
        SUBMIT_TEXT: 'Send',
        FORM_INVALID: 'The form contains errors. Please check the data',
        SUCCESS_TEXT: 'Thanks, we got your message. We will try to respond as soon as possible.',
      },
      ru: {
        NAME_LABEL: 'Ваше имя',
        TEXT_LABEL: 'Текст сообщения',
        EMAIL_LABEL: 'Электронная почта',
        TITLE_LABEL: 'Тема',
        SUBMIT_TEXT: 'Отправить сообщение',
        FORM_INVALID: 'Проверьте правильность заполнения формы',
        SUCCESS_TEXT: 'Ваше сообщение принято. Мы постараемся отреагировать на него как можно скорее.',
      }
    }
  },

  methods: {
    submit() {
      axios
        .post(this.action, {
          name: this.localName,
          mail: this.trap,
          text: this.text,
          email: this.localEmail,
          title: this.localTitle
        })
        .then((response) => {
          if (response.status === 201) {
            notie.alert({
              text: this.successText,
              time: 5,
            })

            this.text = ''
          }
        })
        .catch((error) => {
          if (!error.response) return

          if (error.response.status === 422) {
            notie.alert({
              type: 'error',
              text: this.$i18n.t('FORM_INVALID'),
            })
          }

          if (error.response.status === 429) {
            notie.alert({
              type: 'error',
              text: error.response.data.message,
            })
          }
        })
    }
  }
}
</script>

<template>
<form @submit.prevent="submit">
  <input hidden type="text" name="mail" value="" v-model="trap">

  <div class="mb-4" v-if="!hideName">
    <div class="form-label-group">
      <input required class="form-control" v-model="localName" :placeholder="$t('NAME_LABEL')">
      <label>{{ $t('NAME_LABEL') }}</label>
    </div>
  </div>

  <div class="mb-4">
    <div class="form-label-group">
      <input required class="form-control" type="email" v-model="localEmail" :placeholder="$t('EMAIL_LABEL')">
      <label>{{ $t('EMAIL_LABEL') }}</label>
    </div>
  </div>

  <div class="mb-4" v-if="!hideTitle">
    <div class="form-label-group">
      <input required class="form-control" v-model="localTitle" :placeholder="$t('TITLE_LABEL')">
      <label>{{ $t('TITLE_LABEL') }}</label>
    </div>
  </div>

  <div class="mb-4">
    <label class="font-bold">{{ textareaLabel }}</label>
    <textarea
      required
      class="form-control"
      :class="{ 'textarea-autosized js-autosize-textarea': !isMobile }"
      name="text"
      :rows="!isMobile ? 2 : 4"
      maxlength="1000"
      v-model="text"
    ></textarea>
  </div>

  <button class="btn btn-primary text-lg px-4 py-2" :disabled="!filled">
    {{ submitText }}
  </button>
</form>
</template>
