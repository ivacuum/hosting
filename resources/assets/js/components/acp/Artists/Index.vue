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
      <th>{{ modelFieldTrans('slug') }}</th>
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
        <td>{{ model.slug }}</td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
