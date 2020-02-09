<script>
export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
    imgClasses: {
      type: [Array, Object, String],
      default: 'comment-avatar-size',
    },
    svgClasses: {
      type: [Array, Object, String],
      default: 'w-12 h-12',
    },
  },
}
</script>

<template>
<span>
  <img class="rounded-full" :class="imgClasses" :src="user.avatar" v-if="user.avatar">
  <span v-else>
    <svg class="inline-block align-middle" :class="svgClasses" viewBox="0 0 130 130"><rect x="0" y="0" width="100%" height="100%" rx="50%" :fill="user.color"></rect><text font-size="59.8" font-family="Helvetica Neue,Helvetica,Arial" x="65" y="65" dy=".38em" letter-spacing="-.05em" text-anchor="middle" fill="#fff">{{ user.avatar_text }}</text></svg>
  </span>
</span>
</template>
