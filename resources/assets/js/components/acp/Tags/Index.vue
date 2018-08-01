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
      <th>
        <sortable-header default field="title" default-sort-dir="asc">
          {{ modelFieldTrans('title') }}
        </sortable-header>
      </th>
      <th class="text-md-right text-nowrap">
        <sortable-header field="views">
          <span v-html="$root.svg.eye"></span>
        </sortable-header>
      </th>
      <th class="text-md-right text-nowrap">
        <sortable-header field="photos_count">
          <span v-html="$root.svg.picture_o"></span>
        </sortable-header>
      </th>
    </tr>
    </thead>
    <tbody>
      <tr
        v-for="resource in collection.data"
        :key="resource.id"
        @dblclick="$router.push(resource.edit_url)"
      >
        <td>
          <router-link :to="resource.show_url">
            {{ resource.title }}
          </router-link>
        </td>
        <td class="text-md-right text-nowrap">
          {{ resource.views | decimal }}
        </td>
        <td class="text-md-right text-nowrap">
          <router-link :to="resource.photos_url">
            {{ resource.photos_count | decimal }}
          </router-link>
        </td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
