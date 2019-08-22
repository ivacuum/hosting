<script>
import UserAvatar from './UserAvatar'

export default {
  components: { UserAvatar },
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },
}
</script>

<template>
<div :id="`comment-${comment.id}`" class="tw-flex tw-py-4 tw-w-full border-bottom">
  <aside class="tw-mr-4 md:tw-mr-6">
    <div class="comment-avatar-size tw-mt-1" v-if="comment.user">
      <a :href="comment.user.www">
        <user-avatar :user="comment.user"/>
      </a>
    </div>
    <div class="comment-avatar-size" v-else></div>
  </aside>
  <div class="tw-break-words mw-700 tw-w-full">
    <div>
      <a :href="comment.user.www" v-if="comment.user">{{ comment.user.public_name }}</a>
      <em v-else>deleted user</em>
    </div>
    <div class="comment-body tw-whitespace-pre-line" v-html="comment.html"></div>
    <div class="small text-muted" v-html="comment.posted_at"></div>
  </div>
</div>
</template>
