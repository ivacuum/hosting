<script>
import CommentItem from '../../CommentItem'

export default {
  components: { CommentItem },
  props: {
    resource: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      text: '',
      status: null,
      comments: [],
    }
  },

  watch: {
    'resource.comments' (value) {
      this.comments = value
    },

    'resource.status' (value) {
      this.status = value
    }
  },

  mounted() {
    App.constructor.autosizeTextareas('.js-autosize-textarea-vue')
  },

  methods: {
    close() {
      axios
        .post(`${this.resource.show_url}/close`)
        .then(({ data }) => {
          if (data.status === 'OK') {
            this.status = data.data.status
            return
          }

          notie.alert({ type: 'error', text: data.message })
        })
    },

    comment() {
      axios
        .post(`${this.resource.show_url}/comment`, { text: this.text })
        .then(({ data }) => {
          if (data.status === 'OK') {
            this.text = ''
            this.comments.push(data.data)
          }
        })
    },

    open() {
      axios
        .post(`${this.resource.show_url}/open`)
        .then(({ data }) => {
          if (data.status === 'OK') {
            this.status = data.data.status
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
    <div v-if="status === 1">
      <span class="text-danger" v-html="$root.svg.issue_opened"></span>
      Открыто
      <button class="btn btn-sm btn-default" type="button" @click="close">
        Закрыть
      </button>
    </div>
    <div v-if="status === 2">
      <span class="text-success" v-html="$root.svg.check"></span>
      Закрыто
      <button class="btn btn-sm btn-default" type="button" @click="open">
        Открыть
      </button>
    </div>
  </div>
  <div class="d-flex">
    <div class="bg-light border mt-2 p-2 rounded">
      <div class="text-muted">{{ resource.email }}</div>
      <div><a :href="resource.page">{{ resource.page }}</a></div>
    </div>
  </div>

  <div class="my-3 pre-line">{{ resource.text }}</div>

  <div v-if="comments.length">
    <h3 class="mt-4">
      {{ $t('comments.index') }}
      <small class="text-muted">{{ comments.length }}</small>
    </h3>
    <div v-for="comment in comments" :key="comment.id">
      <comment-item :comment="comment"/>
    </div>
  </div>

  <div v-show="status === 1">
    <div class="my-2">
      <textarea
        required
        class="form-control textarea-autosized js-autosize-textarea-vue"
        rows="1"
        placeholder="Текст ответа..."
        v-model="text"
      ></textarea>
    </div>
    <button class="btn btn-primary" type="button" :disabled="!text" @click="comment">
      Отправить
    </button>
  </div>
</div>
</template>
