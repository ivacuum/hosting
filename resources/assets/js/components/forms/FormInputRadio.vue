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
<div class="form-group form-row">
  <label class="col-md-4 text-md-right" :class="labelClasses">
    <slot name="label">{{ labelText }}</slot>
  </label>
  <div class="col-md-6">
    <slot>
      <label
        class="form-check"
        v-for="option in options"
        :key="option.value"
      >
        <input
          class="form-check-input"
          v-bind="{ name, type, required }"
          :class="inputClasses"
          :value="option.value"
          :checked="value == option.value"
          @change="$emit('input', $event.target.value)"
        >
        <span class="form-check-label">{{ option.label }}</span>
      </label>
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
