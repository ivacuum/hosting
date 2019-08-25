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
<div class="mb-4">
  <label :class="labelClasses">
    <slot name="label">{{ labelText }}</slot>
  </label>
  <slot>
    <label
      class="flex items-center font-normal"
      v-for="option in options"
      :key="option.value"
    >
      <input
        class="mr-2"
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
    <div class="invalid-feedback block" v-if="errors">
      <div v-for="error in errors">{{ error }}</div>
    </div>
  </slot>
  <slot name="help">
    <div class="form-help" v-if="help">{{ help }}</div>
  </slot>
</div>
</template>
