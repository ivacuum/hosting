<script>
import locale from '../i18n/locale'

export default {
  methods: {
    loginUrl(provider) {
      return `${locale}/auth/${provider}?goto=${encodeURIComponent(`${this.$route.fullPath}#comment-add`)}`
    }
  }
}
</script>

<template>
<div class="flex mt-2">
  <div class="mr-2 text-center">
    <a class="btn bg-vk text-xl rounded-full text-white hover:text-white" :href="loginUrl('vk')">
      vk
    </a>
    <div class="mt-1 text-xs text-muted">{{ $t('auth.vk') }}</div>
  </div>
  <div class="mr-2 text-center">
    <a class="btn bg-facebook text-xl rounded-full text-white hover:text-white" :href="loginUrl('facebook')">
      fb
    </a>
    <div class="mt-1 text-xs text-muted">{{ $t('auth.facebook') }}</div>
  </div>
  <div class="mr-2 text-center">
    <a class="btn bg-google text-xl rounded-full text-white hover:text-white" :href="loginUrl('google')">
      gl
    </a>
    <div class="mt-1 text-xs text-muted">{{ $t('auth.google') }}</div>
  </div>
</div>
</template>
