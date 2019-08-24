<script>
import FormInputBase from './FormInputBase.vue'

export default {
  extends: FormInputBase,

  props: {
    type: {
      type: String,
      default: 'radio',
    }
  }
}
</script>

<template>
<div class="tw-mb-4">
  <label :class="labelClasses">
    <slot name="label">{{ labelText }}</slot>
  </label>
  <slot>
    <label
      class="tw-flex tw-items-center tw-font-normal"
      v-for="option in options"
      :key="option.value"
    >
      <input
        class="tw-mr-2"
        v-bind="{ name, type, required }"
        :class="inputClasses"
        :value="option.value"
        :checked="value == option.value"
        @change="$emit('input', $event.target.value)"
      >
      {{ option.label }}
    </label>
  </slot>
  <slot name="feedback">
    <div class="invalid-feedback tw-block" v-if="errors">
      <div v-for="error in errors">{{ error }}</div>
    </div>
  </slot>
  <slot name="help">
    <div class="form-help" v-if="help">{{ help }}</div>
  </slot>
</div>
</template>
