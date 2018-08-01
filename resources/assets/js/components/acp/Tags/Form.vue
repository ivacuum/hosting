<script>
import Model from './Model'
import BaseForm from '../BaseForm.vue'

export default {
  mixins: [Model],
  extends: BaseForm,
}
</script>

<template>
<div>
  <h3 v-if="!isEditing">
    <a href="back" @click.prevent="$router.go(-1)" v-html="$root.svg.chevron_left"></a>
    {{ createTitle }}
  </h3>

  <form class="my-3" ref="form" @submit.prevent="submit">
    <input hidden type="text" name="mail" value="">
    <input hidden type="text" name="_concurrency_control" :value="extra._concurrency_control" v-if="isEditing">

    <form-text required name="title_ru" v-model="model.title_ru"/>
    <form-text required name="title_en" v-model="model.title_en"/>

    <sticky-bottom-buttons v-bind="{ isEditing, saving }" @apply="apply" @stay="storeAndAddAnother"/>
  </form>
</div>
</template>
