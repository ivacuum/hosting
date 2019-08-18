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
      <th></th>
      <th>
        <sortable-header default field="title" default-sort-dir="asc">
          {{ modelFieldTrans('title') }}
        </sortable-header>
      </th>
      <th>{{ modelFieldTrans('slug') }}</th>
      <th class="text-md-right tw-whitespace-no-wrap">
        <sortable-header field="cities_count">
          {{ modelFieldTrans('cities_count') }}
        </sortable-header>
      </th>
      <th class="text-md-right tw-whitespace-no-wrap">
        <sortable-header field="trips_count">
          {{ modelFieldTrans('trips_count') }}
        </sortable-header>
      </th>
      <th class="text-md-right tw-whitespace-no-wrap">
        <sortable-header field="views">
          <span v-html="$root.svg.eye"></span>
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
        <td><img class="d-block flag-16 flag-shadow" :src="resource.flag_url"></td>
        <td>
          <router-link :to="resource.show_url">
            {{ resource.title }}
          </router-link>
        </td>
        <td>
          <a :href="resource.www">
            {{ resource.slug }}
          </a>
        </td>
        <td class="text-md-right tw-whitespace-no-wrap">
          <router-link :to="resource.cities_url">
            {{ resource.cities_count | decimal }}
          </router-link>
        </td>
        <td class="text-md-right tw-whitespace-no-wrap">
          <router-link :to="resource.trips_url">
            {{ resource.trips_count | decimal }}
          </router-link>
        </td>
        <td class="text-md-right tw-whitespace-no-wrap">
          {{ resource.views | decimal }}
        </td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
