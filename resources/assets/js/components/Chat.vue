<template>
<div>
  <div class="chat-container rounded">
    <div class="chat-comment" v-for="message in messages">
      <span class="chat-date" :title="message.date">[{{ message.time }}]</span>
      <span class="chat-user">{{ message.author }}</span>:
      <span class="text-break-word" v-html="message.html"></span>
    </div>
    <!--
    <div class="chat-comment" v-if="typing">
      username is typing...
    </div>
    -->
  </div>
  <form class="mt-1 mb-3" @submit.prevent="post">
    <div class="input-group">
      <input class="form-control" placeholder="Сообщение в чат..." v-model="message">
      <div class="input-group-append">
        <button class="btn btn-default" :disabled="message.length <= 0">Отправить</button>
      </div>
    </div>
  </form>
</div>
</template>

<script>
export default {
  data() {
    return {
      action: '/ajax/chat',
      message: '',
      messages: [],
      typing: false,
      typing_clear_interval: 5000,
      typing_timer_id: ''
    }
  },

  created() {
    this.fetchMessages()
    this.subscribe()
  },

  /*
  watch: {
    message() {
      this.setTyping()
    }
  },
  */

  methods: {
    /*
    clearTyping() {
      clearTimeout(this.typing_timer_id)

      this.typing_timer_id = setTimeout(() => {
        this.typing = false
      }, this.typing_clear_interval)
    },
    */

    fetchMessages() {
      axios.get(this.action)
        .then((response) => {
          this.messages = response.data.data
          this.scrollChatDown()
        })
    },

    getChatContainer() {
      return document.querySelector('.chat-container')
    },

    isScrolledDown(el) {
      return el.scrollHeight - el.scrollTop - el.clientHeight < 5
    },

    post() {
      let form = new FormData()

      form.append('text', this.message)

      axios.post(this.action, form)

      this.message = ''
      this.scrollChatDown()
    },

    /*
    setTyping() {
      Echo.private('chat.typing')
        .whisper('typing', {
          name: 'username'
        })
    },
    */

    scrollChatDown() {
      this.$nextTick(() => {
        let chat_container = this.getChatContainer()

        chat_container.scrollTop = chat_container.scrollHeight
      })
    },

    subscribe() {
      if (typeof Echo === 'undefined') return false

      Echo.channel('chat')
        .listen('ChatMessagePosted', (e) => {
          const is_scrolled_down = this.isScrolledDown(this.getChatContainer())

          this.messages.push(e.message)

          if (is_scrolled_down) {
            this.scrollChatDown()
          }
        })

      /*
      Echo.private('chat.typing')
        .listenForWhisper('typing', (e) => {
          this.typing = true
          this.clearTyping()
        })
      */
    }
  }
}
</script>
