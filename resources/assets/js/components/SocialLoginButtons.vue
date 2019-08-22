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
<div class="tw-flex tw-mt-2">
  <div class="tw-mr-2 tw-text-center">
    <a class="btn bg-vk tw-text-xl tw-rounded-full tw-text-white hover:tw-text-white" :href="loginUrl('vk')">
      vk
    </a>
    <div class="tw-mt-1 small text-muted">{{ $t('auth.vk') }}</div>
  </div>
  <div class="tw-mr-2 tw-text-center">
    <a class="btn bg-facebook tw-text-xl tw-rounded-full tw-text-white hover:tw-text-white" :href="loginUrl('facebook')">
      fb
    </a>
    <div class="tw-mt-1 small text-muted">{{ $t('auth.facebook') }}</div>
  </div>
  <div class="tw-mr-2 tw-text-center">
    <a class="btn bg-google tw-text-xl tw-rounded-full tw-text-white hover:tw-text-white" :href="loginUrl('google')">
      gl
    </a>
    <div class="tw-mt-1 small text-muted">{{ $t('auth.google') }}</div>
  </div>
</div>
</template>
