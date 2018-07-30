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
<div class="form-row sticky-bottom-buttons">
  <div class="col-md-8 offset-md-4">
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
</div>
</template>
