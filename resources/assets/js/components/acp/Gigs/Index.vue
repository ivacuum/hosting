<script>
import Model from './Model'
import ModelsList from '../../../mixins/ModelsList'

export default {
  mixins: [Model, ModelsList],
}
</script>

<template>
<div v-if="loaded">
  <list-header
    :meta="collection.meta"
    :plural="modelPlural"
    :filters="collection.filters"
  />

  <table class="table-stats table-adaptive" v-if="collection.data.length">
    <thead>
    <tr>
      <th class="text-md-right">#</th>
      <th>{{ modelFieldTrans('title') }}</th>
      <th></th>
      <th>
        <sortable-header default field="date">
          {{ modelFieldTrans('date') }}
        </sortable-header>
      </th>
      <th>{{ modelFieldTrans('slug') }}</th>
      <th class="text-md-right text-nowrap">
        <sortable-header field="views">
          <span v-html="$root.svg.eye"></span>
        </sortable-header>
      </th>
      <th v-html="$root.svg.paperclip"></th>
    </tr>
    </thead>
    <tbody>
      <tr
        v-for="(resource, i) in collection.data"
        :key="resource.id"
        @dblclick="$router.push(resource.edit_url)"
      >
        <td class="text-md-right">{{ addition + i + 1 }}</td>
        <td>
          <router-link :to="resource.show_url">
            {{ resource.title }}
          </router-link>
        </td>
        <td>
          <span
            class="tooltipped tooltipped-n"
            aria-label="Заметка пишется"
            v-html="$root.svg.pencil"
            v-if="resource.status === 0"
          ></span>
        </td>
        <td v-html="resource.full_date"></td>
        <td>
          <a :href="resource.www">
            {{ resource.slug }}
          </a>
        </td>
        <td class="text-md-right text-nowrap">
          {{ resource.views | decimal }}
        </td>
        <td>
          <a :href="resource.meta_image" v-if="resource.meta_image">
            <span class="tooltipped tooltipped-n" aria-label="Обложка" v-html="$root.svg.paperclip"></span>
          </a>
        </td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
