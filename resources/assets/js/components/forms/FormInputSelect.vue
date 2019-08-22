<script>
import FormInputBase from './FormInputBase.vue'

export default {
  extends: FormInputBase,

  computed: {
    localValue() {
      return this.value
    }
  }
}
</script>

<template>
<div class="form-group form-row">
  <label class="col-md-4 md:tw-text-right" :class="labelClasses">
    <slot name="label">{{ labelText }}</slot>
  </label>
  <div class="col-md-6">
    <slot>
      <select
        class="custom-select"
        :class="inputClasses"
        v-bind="{ name, required }"
        v-model="localValue"
        @change="$emit('input', $event.target.value)"
      >
        <option :disabled="required" value=""></option>
        <option
          v-for="option in options"
          :key="option.key"
          :value="option.key"
        >{{ option.value }}</option>
      </select>
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
</div>
</template>
