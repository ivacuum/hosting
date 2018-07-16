<script>
import FormInputBase from './FormInputBase.vue'

export default {
  extends: FormInputBase,
}
</script>

<template>
<div class="form-group form-row">
  <label class="col-md-4 text-md-right" :class="labelClasses">
    <slot name="label">{{ labelText }}</slot>
  </label>
  <div class="col-md-6">
    <slot>
      <input
        class="form-control"
        v-bind="{ name, type, value, required, placeholder }"
        :class="inputClasses"
        @input="$emit('input', $event.target.value)"
      >
    </slot>
    <slot name="feedback">
      <div class="invalid-feedback d-block" v-if="errors">
        <div v-for="error in errors">{{ error }}</div>
      </div>
    </slot>
    <slot name="help">
      <div class="form-help" v-if="help">{{ help }}</div>
    </slot>
  </div>
</div>
</template>
