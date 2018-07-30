<script>
import locale from '../../../i18n/locale'
import Model from './Model'
import BaseForm from '../BaseForm.vue'

export default {
  mixins: [Model],
  extends: BaseForm,

  data() {
    return {
      extra: {
        countries: {},
      },
    }
  },

  methods: {
    fillGeodata() {
      const title = this.model[`title_${window.AppOptions.locale}`] || ''
      let country = ''

      this.extra.countries.forEach((el) => {
        if (String(el.key) === String(this.model.country_id)) {
          country = el.value
        }
      })

      if (!title || !country) {
        notie.alert({ text: 'Для геозапроса нужно выбрать страну и указать город' })
        return
      }

      axios
        .get(`${locale}/acp/cities/geodata`, {
          params: {
            q: `${title} ${country}`,
          }
        })
        .then(({ data }) => {
          this.model.lat = data.lat
          this.model.lon = data.lon
        })
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

  <form class="my-3" ref="form" @submit.prevent="submit">
    <input hidden type="text" name="mail" value="">
    <input hidden type="text" name="_concurrency_control" :value="extra._concurrency_control" v-if="isEditing">

    <form-select required name="country_id" :options="extra.countries" v-model="model.country_id"/>

    <form-text required name="title_ru" v-model="model.title_ru"/>
    <form-text required name="title_en" v-model="model.title_en"/>
    <form-text required name="slug" v-model="model.slug"/>

    <form-text name="iata" v-model="model.iata"/>

    <div class="form-group form-row">
      <div class="col-md-6 offset-md-4">
        <button class="btn btn-default" @click.prevent="fillGeodata">
          {{ $t(`cities.fill_geodata`)}}
        </button>
      </div>
    </div>

    <form-text name="lat" v-model="model.lat"/>
    <form-text name="lon" v-model="model.lon"/>

    <sticky-bottom-buttons v-bind="{ isEditing, saving }" @apply="apply" @stay="storeAndAddAnother"/>
  </form>
</div>
</template>
