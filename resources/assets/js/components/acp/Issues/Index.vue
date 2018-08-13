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

  <table class="table-stats table-stats-align-top table-adaptive" v-if="collection.data.length">
    <thead>
    <tr>
      <th class="text-md-right">{{ modelFieldTrans('id') }}</th>
      <th>{{ modelFieldTrans('title') }}</th>
      <th></th>
      <th>{{ modelFieldTrans('author') }}</th>
      <th class="text-md-right text-nowrap">
        <span v-html="$root.svg.comment_o"></span>
      </th>
      <th>{{ modelFieldTrans('created_at') }}</th>
    </tr>
    </thead>
    <tbody>
      <tr
        v-for="resource in collection.data"
        :key="resource.id"
      >
        <td class="text-md-right">{{ resource.id }}</td>
        <td>
          <router-link :to="resource.show_url">
            {{ resource.title }}
          </router-link>
          <div>
            <a class="small" :href="resource.page">
              {{ resource.page }}
            </a>
          </div>
        </td>
        <td>
          <span
            class="text-danger tooltipped tooltipped-n"
            aria-label="Открыто"
            v-html="$root.svg.issue_opened"
            v-if="resource.status === 1"
          ></span>
          <span
            class="text-success tooltipped tooltipped-n"
            aria-label="Закрыто"
            v-html="$root.svg.check"
            v-if="resource.status === 2"
          ></span>
        </td>
        <td>
          <a :href="resource.user_url" v-if="resource.user_id">
            <div>{{ resource.email }}</div>
            <div class="small text-muted">{{ resource.name }}</div>
          </a>
          <div v-else>
            <div>{{ resource.email }}</div>
            <div class="small text-muted">{{ resource.name }}</div>
          </div>
        </td>
        <td class="text-md-right text-nowrap">
          {{ resource.comments_count | decimal }}
        </td>
        <td>{{ resource.created_at }}</td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
