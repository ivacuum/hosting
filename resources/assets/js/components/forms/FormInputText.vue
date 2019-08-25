<script>
import FormInputBase from './FormInputBase.vue'

export default {
  extends: FormInputBase,
}
</script>

<template>
<div class="mb-4">
  <label :class="labelClasses">
    <slot name="label">{{ labelText }}</slot>
  </label>
  <slot>
    <input
      class="form-control"
      v-bind="{ name, type, value, required, placeholder }"
      :class="inputClasses"
      @input="$emit('input', $event.target.value)"
    >
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
