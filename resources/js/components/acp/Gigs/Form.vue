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
        artists: {},
      },
      statuses: [
        { label: 'Скрыт', value: 0 },
        { label: 'Опубликован', value: 1 },
      ],
    }
  },

  methods: {
    fillSlug() {
      const slug = this.model.slug
      const artist = this.extra.artists.filter(el => String(el.key) === String(this.model.artist_id))[0]
      const segments = slug.split('.')

      segments[0] = artist.slug

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

  <form class="my-4" ref="form" @submit.prevent="submit">
    <input hidden type="text" name="mail" value="">
    <input hidden type="text" name="_concurrency_control" :value="extra._concurrency_control" v-if="isEditing">

    <form-select required name="artist_id" :options="extra.artists" v-model="model.artist_id" @input="fillSlug"/>
    <form-select required name="city_id" :options="extra.cities" v-model="model.city_id"/>

    <form-text required name="title_ru" v-model="model.title_ru"/>
    <form-text required name="title_en" v-model="model.title_en"/>

    <form-text required name="slug" v-model="model.slug"/>
    <form-text required name="date" v-model="model.date"/>

    <form-radio required name="status" :options="statuses" v-model="model.status"/>

    <form-text name="meta_description_ru" v-model="model.meta_description_ru"/>
    <form-text name="meta_description_en" v-model="model.meta_description_en"/>
    <form-text name="meta_image" v-model="model.meta_image"/>

    <div class="mb-4" v-if="resource && resource.meta_image">
      <img class="max-w-full h-auto rounded" :src="resource.meta_image" alt="">
    </div>

    <sticky-bottom-buttons v-bind="{ isEditing, saving }" @apply="apply" @stay="storeAndAddAnother"/>
  </form>
</div>
</template>
