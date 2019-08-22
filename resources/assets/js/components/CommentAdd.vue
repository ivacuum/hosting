<script>
import { mapState } from 'vuex'
import UserAvatar from './UserAvatar'
import SocialLoginButtons from './SocialLoginButtons'

export default {
  components: {
    UserAvatar,
    SocialLoginButtons,
  },

  props: {
    user: {
      type: Object,
      required: true,
    },
  },

  computed: mapState({
    guest: state => state.global.guest,
  }),
}
</script>

<template>
<div class="tw-flex tw-pt-3 tw-w-full" id="comment-add">
  <aside class="tw-mr-4 md:tw-mr-6" v-if="!guest">
    <div class="comment-avatar-size tw-mt-1">
      <user-avatar :user="user"/>
    </div>
  </aside>
  <div class="text-break-word mw-700 tw-w-full" v-else>
    <div class="tw-mb-4" v-if="guest">
      <div>Для комментирования необходимо ввести электронную почту или войти в один клик через один из социальных сервисов ниже.</div>
      <!--<div>Please type your email or use one-click sign-in through one of the social services below to comment.</div>-->
      <social-login-buttons/>
    </div>

    <form method="post">
      <div class="tw-mb-2" v-if="guest">
        <input
          required
          class="form-control"
          type="email"
          :placeholder="$t('model.email')"
        >
      </div>
      <textarea
        required
        class="form-control"
        :class="{ 'textarea-autosized js-autosize-textarea': !isMobile }"
        name="text"
        :placeholder="$t('comments.placeholder')"
        :rows="isMobile ? 1 : 4"
        maxlength="1000"
      ></textarea>
      <button class="btn btn-primary tw-mt-2">
        {{ $t('comments.send') }}
      </button>
    </form>
  </div>
</div>
</template>
