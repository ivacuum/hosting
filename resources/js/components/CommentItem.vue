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
<div :id="`comment-${comment.id}`" class="flex py-4 w-full border-b border-grey-200">
  <aside class="mr-4 md:mr-6">
    <div class="comment-avatar-size mt-1" v-if="comment.user">
      <a :href="comment.user.www">
        <user-avatar :user="comment.user"/>
      </a>
    </div>
    <div class="comment-avatar-size" v-else></div>
  </aside>
  <div class="break-words max-w-700px w-full">
    <div>
      <a :href="comment.user.www" v-if="comment.user">{{ comment.user.public_name }}</a>
      <em v-else>deleted user</em>
    </div>
    <div class="comment-body whitespace-pre-line" v-html="comment.html"></div>
    <div class="text-xs text-muted" v-html="comment.posted_at"></div>
  </div>
</div>
</template>
