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
      <th>{{ modelFieldTrans('iata') }}</th>
      <th class="md:text-right whitespace-no-wrap">
        <sortable-header field="trips_count">
          {{ modelFieldTrans('trips_count') }}
        </sortable-header>
      </th>
      <th class="md:text-right whitespace-no-wrap">
        <sortable-header field="views">
          <span v-html="$root.svg.eye"></span>
        </sortable-header>
      </th>
      <th></th>
    </tr>
    </thead>
    <tbody>
      <tr
        v-for="resource in collection.data"
        :key="resource.id"
        @dblclick="$router.push(resource.edit_url)"
      >
        <td class="tooltipped tooltipped-n" :aria-label="resource.country.title">
          <router-link :to="resource.country.show_url">
            <img class="block flag-16 svg-shadow" :src="resource.country.flag_url">
          </router-link>
        </td>
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
        <td class="text-muted">
          {{ resource.iata }}
        </td>
        <td class="md:text-right whitespace-no-wrap">
          <router-link :to="resource.trips_url">
            {{ resource.trips_count | decimal }}
          </router-link>
        </td>
        <td class="md:text-right whitespace-no-wrap">
          {{ resource.views | decimal }}
        </td>
        <td>
          <span
            class="tooltipped tooltipped-n"
            aria-label="Геолокация задана"
            v-if="resource.lat && resource.lon"
            v-html="$root.svg.map_marker"
          ></span>
        </td>
      </tr>
    </tbody>
  </table>

  <div v-else>No {{ modelPlural }} matched the given criteria.</div>

  <pagination :meta="collection.meta"/>
</div>
</template>
