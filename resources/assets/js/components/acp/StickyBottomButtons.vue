<script>
export default {
  inject: ['modelPlural'],

  props: {
    isEditing: {
      type: Boolean,
      default: false,
    },
    saving: {
      type: Boolean,
      default: false,
    },
  }
}
</script>

<template>
<div class="sticky-bottom-buttons">
  <button class="btn btn-primary" :disabled="saving" v-if="!isEditing">
    {{ $t(`${modelPlural}.add`)}}
  </button>
  <button class="btn btn-default" :disabled="saving" @click.prevent="$emit('stay')" v-if="!isEditing">
    {{ $t('add_stay') }}
  </button>
  <button class="btn btn-primary" :disabled="saving" v-if="isEditing">
    {{ $t('save') }}
  </button>
  <button class="btn btn-default" :disabled="saving" @click.prevent="$emit('apply')" v-if="isEditing">
    {{ $t('apply') }}
  </button>
</div>
</template>
