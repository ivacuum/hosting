<script>
export default {
  props: {
    extra: Object,
    resource: Object,
  },
}

// TODO: consider .sync for passing resource
</script>

<template>
<div v-if="resource">
  <div class="row">
    <div class="col-lg-3">
      <div class="list-group tw-text-center">
        <router-link
          class="list-group-item list-group-item-action"
          :to="resource.show_url"
          v-if="resource.show_url"
          exact
        >
          {{ $t(`${extra.i18n_index}.show`) }}
        </router-link>
        <router-link
          class="list-group-item list-group-item-action"
          :to="resource.edit_url"
          v-if="resource.edit_url"
        >
          {{ $t(`${extra.i18n_index}.edit`) }}
        </router-link>
        <router-link
          class="list-group-item list-group-item-action"
          :to="relation.path"
          v-for="relation in extra.relations"
          :key="relation.i18n_index"
        >
          {{ $t(`${relation.i18n_index}.index`) }}
          <span class="text-muted small tw-whitespace-no-wrap">{{ relation.count | decimal }}</span>
        </router-link>
        <a
          class="list-group-item list-group-item-action"
          :href="resource.www"
          v-if="resource.www"
        >
          {{ $t('www') }}
          <span v-html="$root.svg.external_link"></span>
        </a>
        <a class="list-group-item list-group-item-action" href="#" @click.prevent="$emit('destroy')">
          {{ $t('delete') }}
        </a>
      </div>
    </div>
    <div class="col-lg-9">
      <slot name="header">
        <h2 class="tw-mt-4 lg:tw-mt-0 tw-break-words">
          <a href="back" @click.prevent="$router.go(-1)" v-html="$root.svg.chevron_left"></a>
          <slot>{{ resource.breadcrumb }}</slot>
          <slot name="append">
            <small class="text-muted" v-if="resource.id">#{{ resource.id }}</small>
          </slot>
        </h2>
      </slot>

      <router-view :resource="resource"/>
    </div>
  </div>
</div>
</template>
