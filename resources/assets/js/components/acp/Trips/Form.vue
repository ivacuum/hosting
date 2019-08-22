<script>
import Model from './Model'
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

  methods: {
    fillSlug() {
      const slug = this.model.slug
      const city = this.extra.cities.filter(el => String(el.key) === String(this.model.city_id))[0]
      const segments = slug.split('.')

      segments[0] = city.slug

      this.model.slug = segments.join('.')
    }
  }
}
</script>

<template>
<div>
  <h3 v-if="!isEditing">
    <a href="back" @click.prevent="$router.go(-1)" v-html="$root.svg.chevron_left"></a>
    {{ createTitle }}
  </h3>

  <form class="tw-my-4" ref="form" @submit.prevent="submit">
    <input hidden type="text" name="mail" value="">
    <input hidden type="text" name="_concurrency_control" :value="extra._concurrency_control" v-if="isEditing">

    <form-text required name="title_ru" v-model="model.title_ru" v-if="isEditing"/>
    <form-text required name="title_en" v-model="model.title_en" v-if="isEditing"/>

    <form-select required name="city_id" :options="extra.cities" v-model="model.city_id" @input="fillSlug"/>

    <form-text required name="slug" v-model="model.slug"/>
    <form-text required name="date_start" v-model="model.date_start"/>
    <form-text required name="date_end" v-model="model.date_end"/>

    <form-radio required name="status" :options="statuses" v-model="model.status"/>

    <form-text name="meta_description_ru" v-model="model.meta_description_ru"/>
    <form-text name="meta_description_en" v-model="model.meta_description_en"/>
    <form-text name="meta_image" v-model="model.meta_image"/>

    <div class="form-group form-row" v-if="resource && resource.meta_image">
      <div class="col-md-6 offset-md-4">
        <img class="img-fluid tw-rounded" :src="resource.meta_image">
      </div>
    </div>

    <sticky-bottom-buttons v-bind="{ isEditing, saving }" @apply="apply" @stay="storeAndAddAnother"/>
  </form>
</div>
</template>
