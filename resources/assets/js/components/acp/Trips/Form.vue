<script>
import Model from '../../../models/Trip'
import BaseForm from '../BaseForm.vue'

export default {
  mixins: [Model],
  extends: BaseForm,

  data() {
    return {
      extra: {
        cities: {},
      },
      statuses: [
        { label: 'Скрыта', value: 2 },
        { label: 'Неактивна', value: 0 },
        { label: 'Опубликована', value: 1 },
      ],
    }
  },
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
    <input hidden type="text" name="_concurrency_control" :value="extra._concurrency_control">

    <form-text required name="title_ru" v-model="model.title_ru" v-if="isEditing"/>
    <form-text required name="title_en" v-model="model.title_en" v-if="isEditing"/>

    <form-select required name="city_id" :options="extra.cities" v-model="model.city_id"/>

    <form-text required name="slug" v-model="model.slug"/>
    <form-text required name="date_start" v-model="model.date_start"/>
    <form-text required name="date_end" v-model="model.date_end"/>

    <form-radio required name="status" :options="statuses" v-model="model.status"/>

    <form-text name="meta_description_ru" v-model="model.meta_description_ru"/>
    <form-text name="meta_description_en" v-model="model.meta_description_en"/>
    <form-text name="meta_image" v-model="model.meta_image"/>

    <sticky-bottom-buttons v-bind="{ isEditing, saving }" @apply="apply"/>
  </form>
</div>
</template>
