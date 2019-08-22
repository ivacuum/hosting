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
      <th class="md:tw-text-right">#</th>
      <th>{{ modelFieldTrans('title') }}</th>
      <th>{{ modelFieldTrans('slug') }}</th>
    </tr>
    </thead>
    <tbody>
      <tr
        v-for="(resource, i) in collection.data"
        :key="resource.id"
        @dblclick="$router.push(resource.edit_url)"
      >
        <td class="md:tw-text-right">{{ addition + i + 1 }}</td>
        <td>
          <router-link :to="resource.show_url">
            {{ resource.title }}
          </router-link>
        </td>
        <td>{{ resource.slug }}</td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
