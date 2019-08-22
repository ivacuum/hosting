<template>
<div>
  <div class="chat-container tw-antialiased tw-rounded" style="font-size: .875rem;">
    <div v-for="(messagesForDate, date) in messagesGroupedByDate">
      <div class="chat-date tw-my-1 tw-text-center">
        <div class="chat-bg tw-inline-block tw-mx-auto tw-p-1 tw-rounded">{{ date }}</div>
      </div>
      <div class="tw-flex tw-mt-2" v-for="(message, index) in messagesForDate">
        <div class="tw-flex-shrink-0" style="width: 2.75rem;">
          <div v-if="!sameUser[date][index]">
            <img
              class="tw-rounded-full"
              :src="message.user.avatar"
              style="width: 2.25rem; height: 2.25rem;"
              v-if="message.user.avatar"
            >
            <div v-else>
              <svg class="tw-inline-block tw-align-middle" viewBox="0 0 130 130" style="width: 2.25rem; height: 2.25rem;"><rect x="0" y="0" width="100%" height="100%" rx="50%" :fill="message.user.color"></rect><text font-size="59.8" font-family="Helvetica Neue,Helvetica,Arial" x="65" y="65" dy=".38em" letter-spacing="-.05em" text-anchor="middle" fill="#fff">{{ message.user.avatar_text }}</text></svg>
            </div>
          </div>
        </div>
        <div class="tw-flex-grow">
          <div class="tw-leading-none" :style="{ color: message.user.color }" v-if="!sameUser[date][index]">{{ message.user.public_name }}</div>
          <div class="tw-break-words" v-html="message.html"></div>
        </div>
        <div class="tw-flex-shrink-0 chat-time tw-text-right small" :title="message.date" style="width: 3rem;">{{ message.time }}</div>
      </div>
    </div>
    <!--
    <div class="chat-comment" v-if="typing">
      username is typing...
    </div>
    -->
  </div>
  <form class="tw-mt-1 tw-mb-4" @submit.prevent="post">
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
      typing: false,
      message: '',
      messages: [],
      typingClearInterval: 5000,
      typingTimerId: ''
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

  computed: {
    messagesGroupedByDate() {
      return this.messages.reduce((result, message) => {
        if (typeof result[message.date] === 'undefined') result[message.date] = []

        result[message.date].push(message)

        return result
      }, {})
    },

    sameUser() {
      if (!this.messages.length) return

      const result = {}

      Object.entries(this.messagesGroupedByDate).map(([date, messages]) => {
        let previous

        messages.forEach((message) => {
          if (typeof result[date] === 'undefined') result[date] = []

          result[date].push(message.user.id === previous)

          previous = message.user.id
        })
      })

      return result
    }
  },

  methods: {
    /*
    clearTyping() {
      clearTimeout(this.typingTimerId)

      this.typingTimerId = setTimeout(() => {
        this.typing = false
      }, this.typingClearInterval)
    },
    */

    fetchMessages() {
      axios
        .get(this.action)
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
        let chatContainer = this.getChatContainer()

        chatContainer.scrollTop = chatContainer.scrollHeight
      })
    },

    subscribe() {
      if (typeof Echo === 'undefined') return false

      Echo
        .channel('chat')
        .listen('ChatMessagePosted', (e) => {
          const isScrolledDown = this.isScrolledDown(this.getChatContainer())

          this.messages.push(e.message)

          if (isScrolledDown) {
            this.scrollChatDown()
          }
        })

      /*
      Echo
        .private('chat.typing')
        .listenForWhisper('typing', (e) => {
          this.typing = true
          this.clearTyping()
        })
      */
    }
  }
}
</script>
