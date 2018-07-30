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
      <th class="text-md-right">{{ modelFieldTrans('id') }}</th>
      <th>{{ modelFieldTrans('author') }}</th>
      <th>{{ modelFieldTrans('title') }}</th>
      <th>{{ modelFieldTrans('created_at') }}</th>
      <th>{{ modelFieldTrans('page') }}</th>
    </tr>
    </thead>
    <tbody>
      <tr
        v-for="model in collection.data"
        :key="model.id"
      >
        <td class="text-md-right">{{ model.id }}</td>
        <td>
          <a :href="model.user_url" v-if="model.user_id">
            <div>{{ model.name }}</div>
            <div>{{ model.email }}</div>
          </a>
          <div v-else>
            <div>{{ model.name }}</div>
            <div>{{ model.email}}</div>
          </div>
        </td>
        <td>
          <router-link :to="model.show_url">
            {{ model.title }}
          </router-link>
        </td>
        <td>{{ model.created_at }}</td>
        <td>
          <a :href="model.page">
            {{ model.page }}
          </a>
        </td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
