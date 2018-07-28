<script>
import Model from './Model'
import ModelsList from '../../../mixins/ModelsList'

export default {
  mixins: [Model, ModelsList],

  data() {
    return {
      filters: [
        {
          field: 'status',
          title: 'Состояние',
          values: [
            { label: 'Опубликованные', value: 1 },
            { label: 'Пишутся', value: 0 },
            { label: 'Скрытые', value: 2 },
          ],
        },
      ],
    }
  },
}
</script>

<template>
<div v-if="loaded">
  <list-header
    :meta="collection.meta"
    :plural="modelPlural"
    :filters="filters"
  />

  <table class="table-stats table-adaptive">
    <thead>
    <tr>
      <th class="text-md-right">#</th>
      <th>{{ modelFieldTrans('title') }}</th>
      <th></th>
      <th>
        <sortable-header default field="date_start">
          {{ modelFieldTrans('date_start') }}
        </sortable-header>
      </th>
      <th>{{ modelFieldTrans('slug') }}</th>
      <th class="text-md-right text-nowrap">
        <sortable-header field="views">
          <span v-html="$root.svg.eye"></span>
        </sortable-header>
      </th>
      <th class="text-md-right text-nowrap">
        <sortable-header field="comments_count">
          <span v-html="$root.svg.comment_o"></span>
        </sortable-header>
      </th>
      <th v-html="$root.svg.paperclip"></th>
      <th class="text-md-right text-nowrap">
        <sortable-header field="photos_count">
          <span v-html="$root.svg.picture_o"></span>
        </sortable-header>
      </th>
      <th class="text-md-right"></th>
    </tr>
    </thead>
    <tbody>
      <tr
        v-for="(model, i) in collection.data"
        :key="model.id"
        @dblclick="$router.push(model.edit_url)"
      >
        <td class="text-md-right">{{ addition + i + 1 }}</td>
        <td>
          <router-link :to="model.show_url">
            {{ model.title }}
          </router-link>
        </td>
        <td>
          <span
            class="tooltipped tooltipped-n"
            aria-label="Заметка скрыта"
            v-html="$root.svg.eye_slash"
            v-if="model.status === 2"
          ></span>
          <span
            class="tooltipped tooltipped-n"
            aria-label="Заметка пишется"
            v-html="$root.svg.pencil"
            v-if="model.status === 0"
          ></span>
        </td>
        <td v-html="model.localized_date"></td>
        <td>
          <a :href="model.www">
            {{ model.slug }}
          </a>
        </td>
        <td class="text-md-right text-nowrap">
          {{ model.views | decimal }}
        </td>
        <td class="text-md-right text-nowrap">
          <a :href="model.comments_url">
            {{ model.comments_count | decimal }}
          </a>
        </td>
        <td>
          <a :href="model.meta_image" v-if="model.meta_image">
            <span class="tooltipped tooltipped-n" aria-label="Обложка" v-html="$root.svg.paperclip"></span>
          </a>
        </td>
        <td class="text-md-right text-nowrap">
          <a :href="model.photos_url">
            {{ model.photos_count | decimal }}
          </a>
        </td>
        <td class="text-md-right">
          <a :href="model.template_url" v-if="model.user.id === 1" v-html="$root.svg.file_text_o"></a>
          <a :href="model.user_url" v-else>#{{ model.user.id }}</a>
        </td>
      </tr>
    </tbody>
  </table>

  <pagination :meta="collection.meta"/>
</div>
</template>
